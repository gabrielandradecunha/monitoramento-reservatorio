# Sistema de monitoramento de reservatórios d'agua

Este projeto é um sistema de monitoramento de reservatórios de água desenvolvido com Laravel, Docker e PostgreSQL. O sistema coleta dados de níveis de água em tempo real, enviados por um microcontrolador para o banco de dados. A partir dessas informações, o sistema processa e exibe os dados de forma acessível para o administrador, permitindo o acompanhamento e a gestão eficiente dos reservatórios.

Alguns dos dados que o sistema fornece ao administrador

- **Volume**: Armazenamento, capacidade total e armazenamento atual do reservatório.
- **Vazão**: Determina quanto o volume do reservatório aumentou ou diminuiu.
- **Retenção**: Mede o volume total retido (reduções no volume).
- **Velocidade de Vazão e Retenção**: Quantifica as mudanças de volume em relação ao tempo.