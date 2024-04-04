import React, { useRef, useState } from "react";
import axios from "axios";
import '../Styles/InsertImages.css'

function InsertImages() {
  const fileInput = useRef(null);
  const [nome, setNome] = useState(""); // Estado para o nome
  const [descricao, setDescricao] = useState(""); // Estado para a descrição
  const [result, setResult] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append("nome", nome);
    formData.append("image", fileInput.current.files[0]);
    formData.append("descricao", descricao);

    axios.post("http://localhost:8000/components/insertFotografias.php", formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then((response) => {
      setResult(response.data);
      // Limpa os campos após o envio
      setNome("");
      setDescricao("");
      fileInput.current.value = null; // Limpa o input file
    })
    .catch((error) => {
      console.error(error);
    });
  };

  return (
    <div className="FotoForm"><h1>Selecione a fotografia</h1>
      <form onSubmit={handleSubmit}>      
        <input type="file" id="image" name="image" accept="image/*" ref={fileInput} />
        <br />
        <input type="text" id="nome" name="nome" placeholder="Nome da fotografia" value={nome} onChange={e => setNome(e.target.value)} />
        <br />
        <textarea id="descricao" name="descricao" placeholder="Texto para descrever a fotografia" value={descricao} onChange={e => setDescricao(e.target.value)}></textarea>
        <br />
        <button type="submit">Enviar</button>
      </form>
      <h3>{result}</h3>
    </div>
  );
}

export default InsertImages;
