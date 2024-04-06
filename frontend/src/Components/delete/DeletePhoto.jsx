import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../Styles/DeletePhoto.css'

const DeletePhoto = () => {
  const [photos, setPhotos] = useState([]);

  useEffect(() => {
    axios.get("https://familia-gouveia-0f628f261ee1.herokuapp.com/components/eliminarPhoto.php").then(response => {
      setPhotos(response.data);
    });
  }, []);

  const deletePhoto = (id) => {
    const userConfirmation = window.confirm("Tem certeza que deseja eliminar a fotografia?");

    if (userConfirmation) {
      axios.delete(`https://familia-gouveia-0f628f261ee1.herokuapp.com/components/exclusaoPhoto.php?id=${id}`).then(response => {
        console.log(response.data);
        setPhotos(photos.filter(photo => photo.id !== id));
        alert("A fotografia foi eliminada com sucesso!");
      });
    }
  }

  return (
    <div className='deletePhoto'>
      {photos.map(photo => (
        <div key={photo.id}>
          <img 
          width="100%"
          height={350}
          src={`../components/uploadsFotos/${photo.foto}`} alt={photo.nome} />
          <p>{photo.nome}</p>
          <button onClick={() => deletePhoto(photo.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}

export default DeletePhoto;
