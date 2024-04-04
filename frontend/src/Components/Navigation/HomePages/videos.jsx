import React, { useEffect, useRef, useState } from 'react';
import { Link } from 'react-router-dom';
import "../../Styles/videos.css";

const Videos = () => {
    const carousel = useRef(null);
    const playingVideo = useRef(null); // Adicionado para manter o controle do vídeo que está sendo reproduzido

    const [videos, setVideos] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch("http://localhost:8000/components/videos.php", {method: 'GET'});

            if (response.ok) {
                const data = await response.json();
                setVideos(data);
            } else {
                console.error("Erro: " + response.status);
            }
        };
        fetchData();
    }, []);

    const handlePlay = (videoElement) => { // Adicionado para lidar com o evento de reprodução
        if (playingVideo.current && playingVideo.current !== videoElement) {
            playingVideo.current.pause();
        }
        playingVideo.current = videoElement;
    };

    return (
        <div>
            <div><h1 className='container1'>VÍDEOS</h1></div>
            <div className='container-video'> 
                <div className='carousel-video' ref={carousel}>
                    {videos.map((video, index) => {
                        return (
                            <div key={index} className='item-video'>
                                <video className='card-video'
                                    width="100%"
                                    height={350}
                                    controls
                                    onPlay={e => handlePlay(e.target)}> {/* Adicionado para lidar com o evento de reprodução */}
                                    <source src={`../components/uploadsVideos/${video.video}`}></source>
                                </video>
                                <div className='info-video'>
                                    <span className='name-video'>{video.nome}</span>
                                    <span className='desc-video'>{video.desc}</span>
                                    <Link to={`/videopath/${video.id}`}>saber mais</Link>
                                </div>
                            </div>
                        )
                    })}
                </div>
            </div>
        </div>
    );
}

export default Videos;
