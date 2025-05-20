<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MessageTeam;
use App\Models\Hospedagem;
use App\Models\FileMessage;
use Gate;

class MessageTeamController extends Controller
{
    public $hospedagemModel;
    public $isHospedagem;

    public function __construct(){
        // Atribua os valores das propriedades no construtor da classe.
        $this->hospedagemModel = new Hospedagem();
        $this->isHospedagem = $this->hospedagemModel->isHospedagem();
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'img' => 'nullable|mimes:jpeg,png,gif,jpg', // Aceita somente JPEG, PNG e GIF se um arquivo for enviado
                'video' => 'nullable|mimes:mp4,webm',
                'file' => 'nullable|mimes:pdf,docx,doc,txt',
                'message' => 'required_if:file,NULL,video,NULL,img,NULL', // Img é obrigatório se ambos file e texto estiverem vazios
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $team = Team::find($request->id_team);
            if(!$team) return back()->with('danger', 'Turma não encontrada');
            if(Gate::denies('post-team', [$team])) return back()->with('danger', 'Você não tem permissão para postar nesta turma');

            $message = MessageTeam::create([
                'id_user' => auth()->user()->id,
                'id_team' => $request->id_team,
                'text' => $request->message,
            ]);

            // CASO TENHA IMAGEM 
            if($request->hasFile('img') ){
                if($request->file('img')->isValid()){
                    $img = $request->img; //pega imagem do campo
                    $imgName = $message->id_message_team . ".png"; //nome para salvar imagem (id_quiz.png)

                    if($this->isHospedagem){
                        $path = public_path('../img/file_messages'); //caminho para salvar imagem hospedagem (img/img_quiz)
                    }else{
                        $path = public_path('img/file_messages'); //caminho para salvar imagem localhost (public/img/img_quiz)
                    }

                    $request->img->move($path, $imgName);//salva imagem
                    $img_path =  "img/file_messages/" . $imgName;//caminho para salvar no banco

                    FileMessage::create([
                        'id_message_team' => $message->id_message_team,
                        'type_file' => 1,
                        'path_file' => $img_path,
                    ]);

                //erro na imagem
                }else{
                    return redirect('/' . auth()->user()->user_name)->with('danger', 'Não foi possível alterar imagem!');
                }
            }

            // CASO TENHA VIDEO 
            if($request->hasFile('video') ){
                if($request->file('video')->isValid()){
                    $video = $request->video; //pega imagem do campo
                    $videoName = $message->id_message_team . ".mp4"; //nome para salvar imagem (id_quiz.png)
                    
                    if($this->isHospedagem){
                        $path = public_path('../img/file_messages'); //caminho para salvar imagem hospedagem (img/img_quiz)
                    }else{
                        $path = public_path('img/file_messages'); //caminho para salvar imagem localhost (public/img/img_quiz)
                    }

                    $request->video->move($path, $videoName);//salva imagem
                    $video_path =  "img/file_messages/" . $videoName;//caminho para salvar no banco

                    FileMessage::create([
                        'id_message_team' => $message->id_message_team,
                        'type_file' => 2,
                        'path_file' => $video_path,
                    ]);

                //erro na imagem
                }else{
                    return redirect('/' . auth()->user()->user_name)->with('danger', 'Não foi possível alterar imagem!');
                }
            }

            // CASO TENHA VIDEO 
            if($request->hasFile('file') ){
                if($request->file('file')->isValid()){
                    $file = $request->file; //pega imagem do campo
                    $extensao = $file->extension(); //pega imagem do campo
                    $originalName = $file->getClientOriginalName(); // Pega o nome original do arquivo
                    $fileName = "$message->id_message_team.$extensao"; //nome para salvar imagem (id_quiz.png)
                    
                    if($this->isHospedagem){
                        $path = public_path('../img/file_messages'); //caminho para salvar imagem hospedagem (img/img_quiz)
                    }else{
                        $path = public_path('img/file_messages'); //caminho para salvar imagem localhost (public/img/img_quiz)
                    }

                    $request->file->move($path, $fileName);//salva imagem
                    $file_path =  "img/file_messages/" . $fileName;//caminho para salvar no banco

                    FileMessage::create([
                        'id_message_team' => $message->id_message_team,
                        'type_file' => 3,
                        'file_name' => $originalName,
                        'path_file' => $file_path,
                    ]);

                //erro na imagem
                }else{
                    return redirect('/' . auth()->user()->user_name)->with('danger', 'Não foi possível alterar imagem!');
                }
            }

            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with('danger', 'Não foi possivel enviar mensagem. Tente novamente mais tarde');
        }
    }

    public function delete($id_message_team){
        try{
            $message = MessageTeam::find($id_message_team);
            if(!$message) return back()->with('danger', 'Mensagem não encontrada');
            if(Gate::denies('delete-team-message', $message)) return back()->with('danger', 'Você não tem permissão para apagar esta mensagem');

            $files = FileMessage::where('id_message_team', $id_message_team)->get()->all();

            foreach($files as $file){
                $file->delete();

                //pega caminho do arquivo
                $path_file = public_path($file->path_file); //pega caminho da imagem localhost (public/img/img_account)
                //$img_user_Path = public_path('../img/img_account/' . $id . '.png'); //pega caminho da imagem hospedagem (img/img_account)

                //verifica se tem imagem
                if (file_exists($path_file)) {
                    unlink($path_file); // Remove o arquivo
                }

            }

            $message = MessageTeam::where('id_message_team', $id_message_team)->get()->first()->delete();

            return redirect()->back()->with('success', 'Mensagem apagada');
        }catch(\Exception $e){
            return redirect()->back()->with('danger', 'Não foi possivel apagar mensagem. Tente novamente mais tarde');
        }
    }

    public function update(Request $request){
        try{
            $request->validate([
                'message' => ['required'],
            ]);

            $message = MessageTeam::where('id_message_team', $request->id_message_team)->get()->first();
            if(!$message) return back()->with('danger', 'Mensagem não encontrada');
            if(Gate::denies('edit-team-message', $message)) return back()->with('danger', 'Você não tem permissão para atualizar esta mensagem');

            $message ->update([
                'text' => $request->message,
            ]);

            return redirect()->back()->with('success', 'Mensagem atualizada');
        }catch(\Exception $e){
            return redirect()->back()->with('danger', 'Não foi possivel atualizar mensagem. Tente novamente mais tarde');
        }
    }
}
