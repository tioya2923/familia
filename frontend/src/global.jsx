import { createGlobalStyle } from "styled-components";

export const GlobalStyles = createGlobalStyle`
    html, body {
        margin: 0;
        padding: 0;
    }

    *, *::after, *::before {
        box-sizing: border-box;
    }

    body {
        align-items: center;
        background: ${({ theme }) => theme.primaryDark};
        color: ${({ theme }) => theme.primaryLight};
       
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        
       
        text-rendering: optimizeLegibility;

        @media (max-width: ${({ theme }) => theme.phones}) {
            font-size: 0.7rem;
            text-align: center;
            color: black;           
            background: ${({ theme }) => theme.primaryPhones};
                      
        }

        @media (min-width: ${({ theme }) => theme.mobiles}) {
            font-size: 0.9rem;
            text-align: center;
            color: black;
            background: ${({ theme }) => theme.primaryMobiles} 
        }

        @media (min-width: ${({ theme }) => theme.tablets}) {
            font-size: 1.1rem;
            text-align: center;
            color: black;
            background: ${({ theme }) => theme.primaryTablets} 
        }
        
        @media (min-width: ${({ theme }) => theme.laptops}) {
            font-size: 1.2rem;
            text-align: center;
            color: black;
            background: ${({ theme }) => theme.primaryLaptops} 
        }


        @media (min-width: ${({ theme }) => theme.largeLaptops}) {
            font-size: 1.4rem;
            text-align: center;
            color: black;
            background: ${({ theme }) => theme.primaryLargeLaptops} 
        }
}



`;