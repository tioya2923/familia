import React from "react";
import "./Footer.css";

const Footer = () => {
    const navigation = [
        { link: "fotografias", text: "Fotografias" },
        { link: "videos", text: "Vídeos" },        
        { link: "areaPessoal", text: "Área Pessoal" },
    ];

    return (
        <div className="container-footer">
            <div>
               
               
                    <ul className="footer-nav">
                        {navigation.map((nav) => (
                            <li key={nav.text}>
                                <a href={nav.link}>{nav.text}</a>
                            </li>
                        ))}
                    </ul>
                
            </div>
        </div>
    );
}; 

export default Footer;
