import React, { useEffect, useRef, useState } from "react";
//import fotos from '../../Store/StoreDatas.json';
import { Link } from "react-router-dom";
import "../../Styles/fotografias.css";
const Fotografias = () => {
    const carousel = useRef(null);
    const [images, setImages] = useState([]);
    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch("http://localhost:8000/components/fotografias.php", { method: "GET" });
            if (response.ok) {
                const data = await response.json();
                setImages(data);
            } else {
                console.error("Erro: " + response.status);
            }
        };
        fetchData();
    }, []);
    return (
        <div className='container'> <h1>FOTOGRAFIAS</h1>
            <div className='carousel-foto' ref={carousel}>
                {images.map((image, index) => {
                    return (
                        <div key={index} className='item'>
                            <img className='card-foto' 
                                src={`../components/uploadsFotos/${image.foto}`} alt={image.data_hora} />
                            <div className='info'>
                                <span className='name'> {image.nome}</span>                            
                                <Link target='_blank' to={`/imagem/${image.id}`}>Saber mais</Link>
                            </div>
                        </div>
                    );
                })}
            </div>

        </div>
    );
};
export default Fotografias; 