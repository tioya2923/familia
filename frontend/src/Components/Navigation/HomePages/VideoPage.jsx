import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { Link } from "react-router-dom";
import "../../Styles/VideoPage.css";

const VideoPage = () => {
    const [video, setVideo] = useState(null);
    const { id } = useParams();

    useEffect(() => {
        const fetchVideo = async () => {
            const response = await fetch(`http://localhost:8000/components/videoPage.php?id=${id}`, { method: "GET" });
            if (response.ok) {
                const data = await response.json();
                setVideo(data);
            } else {
                console.error("Erro: " + response.status);
            }
        };
        fetchVideo();
    }, [id]);

    if (!video) {
        return <div>Carregando...</div>;
    }
    return (
        <div>
            <video className='card-video'
                width="100%"
                height={350}
                controls>
                <source src={`../components/uploadsVideos/${video.video}`}>
                </source>
            </video>
            <div className='descricao'>
                <p>{video.descricao}</p>

            </div>
            <div className='voltar'>
            <Link to="/videos" className='voltar-a-pagina'>voltar</Link>
            </div>

        </div>

    );
};

export default VideoPage;
