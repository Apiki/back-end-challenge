- Conversão BRL ↔ EUR
- Validação de moedas permitidas

📸 **Evidências:**

1. **API em execução (localhost):**  
   ![API funcionando]({FFEEF018-C2C4-44BF-B2A4-03FB3F362D22}.png)  
   *Exemplo de chamada: `/exchange/10/BRL/USD/4.50`*
   

   ### 2. USD → BRL
   ![USD para BRL]({9E1B45E9-24DB-42B4-80EA-3380022CAD20}.png)

   ### 3. BRL → EUR
![BRL para EUR]({44B8A456-421D-443E-BB5A-76884CC38E5B}.png)

### 4. EUR → BRL
![EUR para BRL]({B092442A-FBEE-4DA6-ADD9-C55DD89BF950}.png)

2. **Testes passando:**  
   ![composer test]({479495F7-6DFB-477F-A44A-6AA6C1062557}.png)  
   *Todos os testes OK*

3. **Análise de código:**  
   ![composer lint]({13653163-8B24-4DC0-9202-15D829A17CD2}.png)  
   *Sem erros de estilo*

🔧 **Como testar:**
1. Clone o repositório
2. `composer install`
3. ` php -S localhost:8000 src/index.php`
4. Acesse os endpoints ou execute `composer test` e `composer lint`