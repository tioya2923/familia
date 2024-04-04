import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../Styles/DeleteVideo.css'

const DeleteVideo = () => {
    const [videos, setVideos] = useState([]);

    useEffect(() => {
        axios.get("http://localhost:8000/components/eliminarVideo.php").then(response => {
            setVideos(response.data);
        });
    }, []);

    const deleteVideo = (id) => {
        const userConfirmation = window.confirm("Tem certeza que deseja eliminar este vídeo?");

        if (userConfirmation) {
            axios.delete(`http://localhost:8000/components/exclusaoVideo.php?id=${id}`).then(response => {
                console.log(response.data);
                setVideos(videos.filter(video => video.id !== id));
                alert("O vídeo foi eliminado com sucesso!");
            });
        }
    }

    return (
        <div className='delete-video'>
            {videos.map(video => (
                <div key={video.id}>
                    <video className='card-video'
                        width="100%"
                        height={350}
                        controls>
                        <source src={`../components/uploadsVideos/${video.video}`}></source>
                    </video>
                    <p>{video.nome}</p>
                    <button onClick={() => deleteVideo(video.id)}>Eliminar</button>
                </div>
            ))}
        </div>
    );
}

export default DeleteVideo;
