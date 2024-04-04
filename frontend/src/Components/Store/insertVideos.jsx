import React, { useRef, useState } from "react";
import axios from "axios";
import ReactPlayer from "react-player"; // importa o componente ReactPlayer
import '../Styles/InsertVideos.css'

function InsertVideos() {
    // Cria uma referência para o input file
    const fileInput = useRef(null);

    // Cria um estado para o resultado
    const [result, setResult] = useState("");

    // Cria um estado para a URL do vídeo
    const [videoURL, setVideoURL] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
    
        const formData = new FormData();
        formData.append("nome", e.target.nome.value);
        formData.append("video", fileInput.current.files[0]);
        formData.append("descricao", e.target.descricao.value);
    
        axios
            .post("http://localhost:8000/components/insertVideos.php", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                setResult(response.data);
                // Limpa os campos após o envio
                e.target.nome.value = "";
                e.target.descricao.value = "";
                fileInput.current.value = null;
                setVideoURL(""); // Limpa a URL do vídeo
            })
            .catch((error) => {
                console.error(error);
            });
    };
    
    // Define a função que será chamada ao mudar o input file
    const handleFileChange = (e) => {
        // Obtém o arquivo de vídeo selecionado
        const file = e.target.files[0];

        // Verifica se o navegador suporta o FileReader
        if (window.FileReader) {
            // Cria um objeto FileReader
            const reader = new FileReader();

            // Define a função que será chamada quando o arquivo for lido
            reader.onload = (event) => {
                // Obtém a URL base64 do arquivo
                const url = event.target.result;

                // Atualiza o estado com a URL do vídeo
                setVideoURL(url);
            };

            // Lê o arquivo como uma URL base64
            reader.readAsDataURL(file);
        } else {
            // Usa uma alternativa, como uma requisição AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("GET", file);
            xhr.onload = () => {
                // Obtém a URL base64 do arquivo
                const url = xhr.responseText;

                // Atualiza o estado com a URL do vídeo
                setVideoURL(url);
            };
            xhr.send();
        }
    };


    return (
        <div className="VideoForm"><h1>Selecione o vídeo</h1>
            <form onSubmit={handleSubmit}>
               
                <label htmlFor="video"></label>
                <input type="file" id="video" name="video" accept="video/*" ref={fileInput} onChange={handleFileChange} />
                <br />
                <label htmlFor="nome"></label>
                <input type="text" id="nome" name="nome" placeholder="Nome do vídeo"/>
                <br />
                <label htmlFor="descricao"></label>
                <textarea type="text" id="descricao" name="descricao" placeholder="Texto para descrever o vídeo"></textarea> 
                <br />
                <button type="submit">Enviar</button>
            </form>
            <h3>{result}</h3>
            <div className="VideoPlayer">
                <ReactPlayer url={videoURL} width="25" height="25" controls={true} />
            </div>
        </div>
    );
}
export default InsertVideos;
