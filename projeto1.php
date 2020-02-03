<?php include("conexao.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style >
		canvas{
			position:absolute;		
			top:0px;
			bottom:0px;
			left:0px;
			right:0px;
			margin:auto;
			
		}
		form{
			
			
			width:600px;
			bottom:10px;
			margin-left:200;
			align-content: center;
		}
		.botao{
			width: 80px;
		}
		.nick{
			width:200px;
		}

	</style>
	<script type="text/javascript" href="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
</head>
<body>


	
		<center><input type="text"class="nick"id="nickname">	</center>
		
		
	<script type="text/javascript">


		
		var canvas, ctx, ALTURA, LARGURA,frames=0,pisca=0,tempoinsere=0,img = new Image(),iniciaenter=false,movec=false,moveb=false,movee=false,moved=false,px=0, py=0,posicaocometa=0,coordx=0,coordy=0,contscore=0,click=false, inserejogador=true, teste1=false,qtdranking=0;;
		
		
		jogadores={
			_jogadores:[],
			insere: function(){
				
				var nick=document.getElementById("nickname").value;
				
			
					this._jogadores.push({
					nome:nick,
					jscore:0,

				})

			
				
			},
			ordena: function(){
				var aux=0;
				var tam=this._jogadores.length;
				for (var i=0;i<=tam;i++){
					for(var j=0;j<tam-1;j++){
						if(this._jogadores[j+1].jscore>this._jogadores[j].jscore){
							aux=this._jogadores[j+1];
							this._jogadores[j+1]=this._jogadores[j];
							this._jogadores[j]=aux;
							
						}
					}
					
				}
			}

		}
		cometas={
			_cometas:[],
			insere: function(){
				this._cometas.push({
							score:0,
							y:-20,
							
							x:Math.floor(Math.random()*LARGURA),
							controlado:Math.floor(Math.random()*2),
							altura:1,			
							largura:1,
							cor:"#a0a0a0",
							gravidade:0.005+Math.random()*0.008,
							velocidadeV:0,
							velocidadeH:0,	
							
			
	
				})
			},
	
			cometaexplode: function(posicao){
				
					var cometa=this._cometas[posicao];
					ctx.fillStyle=cometa.cor;
					for(var i=0;i<21;i++){
						for(var j=0;j<22;j++){
							if(i==0&&j>6&&j<15||i==1&&j>3&&j<16||i==2&&j>3&&j<16||i==2&&j>1&&j<16 ||i==3&&j>1&&j<17||i==4&&j>1&&j<18||i==5&&j>0&&j<21||i==6&&j>0&&j<21||i==7&&j>-1&&j<22||i==8&&j>-1&&j<22||i==9&&j>-1&&j<22||i==10&&j>-1&&j<22||i==11&&j>-1&&j<22||i==12&&j>0&&j<22||i==13&&j>0&&j<19||i==14&&j>0&&j<19||i==15&&j>0&&j<19||i==16&&j>0&&j<18||i==17&&j>0&&j<19||i==17&&j>0&&j<17||i==18&&j>9&&j<17||i==19&&j>9&&j<17||i==20&&j>12&&j<16){	
								ctx.fillRect(cometa.x+j+Math.floor(Math.random()*40),cometa.y+i+Math.floor(Math.random()*40),cometa.largura,cometa.altura);
							}
											
						}
													
					}
									
				
					
				
					var cometa=this._cometas[posicao];
					ctx.fillStyle="#707070";
					for(var i=0;i<21;i++){
						for(var j=0;j<22;j++){
							if(i==4&&j>4&&j<6||i==5&&j>3&&j<7||i==6&&j>2&&j<8||i==7&&j>2&&j<8||i==8&&j>3&&j<7||i==9&&j>4&&j<6||i==13&&j>10&&j<13||i==14&&j>9&&j<14||i==15&&j>10&&j<13){
						
						
								ctx.fillRect(cometa.x+j+Math.floor(Math.random()*-40),cometa.y+i+Math.floor(Math.random()*-40),cometa.largura,cometa.altura);
							}
											
						}
													
					}
									
				
					
				
			},
			atualiza: function(){
				for(var k=0,tam=this._cometas.length;k<tam;k++)	{
					var cometa=this._cometas[k];
					velocidadeInicial=this.y;
							
							
								
							if(cometa.x<(LARGURA-14) && cometa.controlado==0){
													
								cometa.velocidadeH+=cometa.gravidade;
								cometa.x+= cometa.velocidadeH;
													
			
							}
							else if(cometa.x>=LARGURA-14){
								cometa.controlado=1
								cometa.x=LARGURA-14;
							}
							if(cometa.controlado==1){
												
								cometa.x-= cometa.velocidadeH;
								if (cometa.x<=0){
									cometa.velocidadeH=5;
									cometa.controlado=0;
								}
												
												
												
												
							}
							if(cometa.y>=ALTURA){
								cometa.score++;	
								cometa.y=-20;
							
								cometa.x=Math.floor(Math.random()*LARGURA-25);
											
			
							}
							if(cometa.velocidadeV>10){
									cometa.velocidade=10;
							}
							else{
								cometa.velocidadeV+=cometa.gravidade;
							}											
							
							cometa.y+= cometa.velocidadeV;			
				
				}
				
							
			},
			desenha: function(){
				for(var k=0;k<this._cometas.length;k++)	{
					var cometa=this._cometas[k];
					ctx.fillStyle=cometa.cor;
					for(var i=0;i<21;i++){
						for(var j=0;j<22;j++){
							if(i==0&&j>6&&j<15||i==1&&j>3&&j<16||i==2&&j>3&&j<16||i==2&&j>1&&j<16 ||i==3&&j>1&&j<17||i==4&&j>1&&j<18||i==5&&j>0&&j<21||i==6&&j>0&&j<21||i==7&&j>-1&&j<22||i==8&&j>-1&&j<22||i==9&&j>-1&&j<22||i==10&&j>-1&&j<22||i==11&&j>-1&&j<22||i==12&&j>0&&j<22||i==13&&j>0&&j<19||i==14&&j>0&&j<19||i==15&&j>0&&j<19||i==16&&j>0&&j<18||i==17&&j>0&&j<19||i==17&&j>0&&j<17||i==18&&j>9&&j<17||i==19&&j>9&&j<17||i==20&&j>12&&j<16){	
								ctx.fillRect(cometa.x+j,cometa.y+i,cometa.largura,cometa.altura);
							}
											
						}
													
					}
									
				
				}	
				for(var k=0;k<this._cometas.length;k++)	{
					var cometa=this._cometas[k];
					ctx.fillStyle="#707070";
					for(var i=0;i<21;i++){
						for(var j=0;j<22;j++){
							if(i==4&&j>4&&j<6||i==5&&j>3&&j<7||i==6&&j>2&&j<8||i==7&&j>2&&j<8||i==8&&j>3&&j<7||i==9&&j>4&&j<6||i==13&&j>10&&j<13||i==14&&j>9&&j<14||i==15&&j>10&&j<13){
						
						
								ctx.fillRect(cometa.x+j,cometa.y+i,cometa.largura,cometa.altura);
							}
											
						}
													
					}
									
				
				}			
					
			},
			desenhacolisao: function(){
				for(var k=0;k<this._cometas.length;k++)	{
					var cometa=this._cometas[k];
					ctx.fillStyle=ctx.fillStyle="rgba(255,255,255,0)"
					ctx.fillRect(cometa.x,cometa.y,22,20);
				}
			}
		},
		nave={
			y:0,
			x:0,
			controlado:0,
			altura:1,			
			largura:1,
			cor:"#afafaf",
			velocidade:7,
			direita:function(){
				if(this.x>=((LARGURA/2-24))){
					this.x=(LARGURA/2-15);
				}else{
					this.x+=this.velocidade;
				}
				
				
				
			},
			esquerda:function(){
				if(this.x<=-((LARGURA/2)-15)){
					this.x=-((LARGURA/2)-5);

				}else{
					this.x-=this.velocidade;
				}
				
				
				
			},
			cima:function(){
				if(this.y<=-ALTURA+50){
					
					this.y=-ALTURA+40;
				}else{
					
					this.y-=this.velocidade;
				}
				
				
			},
			baixo:function(){
				if(this.y>=-3){
					this.y=0
				}else{
					this.y+=this.velocidade;
				}
				
				
			},
			desenhacolisao: function(){
				ctx.fillStyle="rgba(0,0,0,0)"

				ctx.fillRect(this.x+(LARGURA/2)-1,this.y+ALTURA-40,14,40);
			},
			desenhaTurbina: function(){
				ctx.fillStyle="orange";
				
					
					for (var i=0;i<17;i++){
						for(var j=0;j<11;j++){
							
							if((i==0&&j>2&&j<8)||(i==1&&j>1&&j<9)||(i==2&&j>0&&j<10)||(i==3&&j>0&&j<10)||(i>3&&i<9)||(i==9&&j>0&&j<10)||(i==10&&j>0&&j<10)||(i==11&&j>1&&j<9)||(i==12&&j>1&&j<9)||(i==13&&j>2&&j<8)||(i==14&&j>2&&j<8)||(i==15&&j>3&&j<7)||(i==16&&j>4&&j<6)){
								
								ctx.fillRect(this.x+(LARGURA/2)+j,this.y+ALTURA-18+i,this.largura,this.altura);
							
							}
							
						}
					}
					ctx.fillStyle="red";
					for (var i=0;i<17;i++){
						for(var j=0;j<11;j++){
							
							if((i==1&&j==4||i==1&&j==6)||(i==2&&j>2&&j<8)||(i==3&&j>2&&j<8)||(i==4&&j>1&&j<9)||(i==5&&j>1&&j<9)||(i==6&&j>1&&j<9)||(i==7&&j>1&&j<9)||(i==8&&j>1&&j<9)||(i==9&&j>2&&j<8)||(i==10&&j>2&&j<8)||(i==11&&j>3&&j<7)||(i==12&&j>3&&j<7)||(i==13&&j==5)){
								ctx.fillRect(this.x+(LARGURA/2)+j,this.y+ALTURA-18+i,this.largura,this.altura);
							
							}
							
						}
					}
					ctx.fillStyle="white";
					for (var i=0;i<7;i++){
						for(var j=0;j<3;j++){
							ctx.fillRect(this.x+(LARGURA/2)+4+j,this.y+ALTURA-16+i,this.largura,this.altura);
						}
					}
					
					for (var i=2;i<5;i++){
						for(var j=-1;j<4;j+=4){
							
							ctx.fillRect(this.x+(LARGURA/2)+4+j,this.y+ALTURA-16+i,this.largura,this.altura);
						}
					}
					
					for (var i=-1;i<8;i+=8){
						for(var j=1;j<2;j++){
							
							ctx.fillRect(this.x+(LARGURA/2)+4+j,this.y+ALTURA-16+i,this.largura,this.altura);
						}
					}
			},
			desenhaNave: function(){
				ctx.fillStyle="white";
				
					
					for (var i=0;i<25;i++){
						for(var j=-5;j<16;j++){	
							if((i==4&&j==2)||(i==4&&j==8)||(i==5&&j>0&&j<10)||(i==6&&j>0&&j<10)||(i==7&&j>0&&j<10)||(i==8&&j>0&&j<10)||(i==9&&j>-1&&j<11)||(i==10&&j>-1&&j<11)||(i==11&&j>-1&&j<11)||(i==12&&j>-2&&j<12)||(i==13&&j>-2&&j<12)||(i==14&&j>-2&&j<12)||(i==15&&j>-2&&j<12)||(i==16&&j>-2&&j<12)||(i==17&&j>-2&&j<12)||(i==18&&j>-1&&j<11)||(i==19&&j>-1&&j<11)||(i==20&&j>-1&&j<11)||(i==21&&j>0&&j<10)||(i==22&&j>1&&j<9)||(i==23&&j>2&&j<8)||(i==23&&j>2&&j<8))	{
								ctx.fillRect(this.x+(LARGURA/2)+j,this.y+ALTURA-40+i,this.largura,this.altura);
							}			
										
						}
					}
					ctx.fillStyle="red";
					for (var i=0;i<26;i++){
						for(var j=-5;j<16;j++){
							
							if((i==0&&j==5)||(i==1&&j>3&&j<7)||(i==2&&j>2&&j<8)||(i==3&&j>1&&j<9)||(i==4&&j>2&&j<8)||(i==18&&j==5)||i==18&&j==-1||i==18&&j==11||(i==19&&j==5)||i==19&&j<0&&j>-3||i==19&&j<13&&j>10||i==20&&j<0&&j>-4||i==20&&j<7&&j>3||i==20&&j<14&&j>10||i==21&&j<1&&j>-5 ||i==21&&j<7&&j>3||i==21&&j<15&&j>9||i==22&&j<-1&&j>-5||i==22&&j<7&&j>3||i==22&&j<15&&j>11||i==23&&j<-1&&j>-5||i==23&&j<7&&j>3||i==23&&j<15&&j>11||i==24&&j<-3&&j>-6||i==24&&j<16&&j>13||(i==24&&j==5)||i==25&&j<-5&&j>-7||i==25&&j<17&&j>15||(i==25&&j==5)){
								ctx.fillRect(this.x+(LARGURA/2)+j,this.y+ALTURA-40+i,this.largura,this.altura);
							
							}
							
						}
					}

					ctx.fillStyle="blue";
					for (var i=0;i<25;i++){
						for(var j=-5;j<16;j++){
							if(i==7&&j>3&&j<7||i==8&&j>2&&j<8||i==9&&j>1&&j<9||i==10&&j>0&&j<10||i==11&&j>0&&j<10||i==12&&j>0&&j<10||i==13&&j>1&&j<9||i==14&&j>2&&j<8||i==15&&j>4&&j<6){
								ctx.fillRect(this.x+(LARGURA/2)+j,this.y+ALTURA-40+i,this.largura,this.altura);
							}
						}
					}
					
				
			},
			naveexplode: function(){
				ctx.fillStyle="white";
				
					
				for (var i=0;i<25;i++){
					for(var j=-5;j<16;j++){	
						if((i==4&&j==2)||(i==4&&j==8)||(i==5&&j>0&&j<10)||(i==6&&j>0&&j<10)||(i==7&&j>0&&j<10)||(i==8&&j>0&&j<10)||(i==9&&j>-1&&j<11)||(i==10&&j>-1&&j<11)||(i==11&&j>-1&&j<11)||(i==12&&j>-2&&j<12)||(i==13&&j>-2&&j<12)||(i==14&&j>-2&&j<12)||(i==15&&j>-2&&j<12)||(i==16&&j>-2&&j<12)||(i==17&&j>-2&&j<12)||(i==18&&j>-1&&j<11)||(i==19&&j>-1&&j<11)||(i==20&&j>-1&&j<11)||(i==21&&j>0&&j<10)||(i==22&&j>1&&j<9)||(i==23&&j>2&&j<8)||(i==23&&j>2&&j<8))	{
							ctx.fillRect(this.x+(LARGURA/2)+j+Math.floor(Math.random()*100),this.y+ALTURA-40+i-5+Math.floor(Math.random()*100),this.largura,this.altura);
						}			
									
					}
				}
				ctx.fillStyle="red";
				for (var i=0;i<26;i++){
					for(var j=-5;j<16;j++){
						
						if((i==0&&j==5)||(i==1&&j>3&&j<7)||(i==2&&j>2&&j<8)||(i==3&&j>1&&j<9)||(i==4&&j>2&&j<8)||(i==18&&j==5)||i==18&&j==-1||i==18&&j==11||(i==19&&j==5)||i==19&&j<0&&j>-3||i==19&&j<13&&j>10||i==20&&j<0&&j>-4||i==20&&j<7&&j>3||i==20&&j<14&&j>10||i==21&&j<1&&j>-5 ||i==21&&j<7&&j>3||i==21&&j<15&&j>9||i==22&&j<-1&&j>-5||i==22&&j<7&&j>3||i==22&&j<15&&j>11||i==23&&j<-1&&j>-5||i==23&&j<7&&j>3||i==23&&j<15&&j>11||i==24&&j<-3&&j>-6||i==24&&j<16&&j>13||(i==24&&j==5)||i==25&&j<-5&&j>-7||i==25&&j<17&&j>15||(i==25&&j==5)){
							ctx.fillRect(this.x+(LARGURA/2)+j+Math.floor(Math.random()*100),this.y+ALTURA-40+i-5+Math.floor(Math.random()*100),this.largura,this.altura);
						
						}
						
					}
				}

				ctx.fillStyle="blue";
				for (var i=0;i<25;i++){
					for(var j=-5;j<16;j++){
						if(i==7&&j>3&&j<7||i==8&&j>2&&j<8||i==9&&j>1&&j<9||i==10&&j>0&&j<10||i==11&&j>0&&j<10||i==12&&j>0&&j<10||i==13&&j>1&&j<9||i==14&&j>2&&j<8||i==15&&j>4&&j<6){
							ctx.fillRect(this.x+(LARGURA/2)+j+Math.floor(Math.random()*100),this.y+ALTURA-40+i-5+Math.floor(Math.random()*100),this.largura,this.altura);
						}
					}
				}
				ctx.fillStyle="orange";
				
					
					for (var i=0;i<17;i++){
						for(var j=0;j<11;j++){
							
							if((i==0&&j>2&&j<8)||(i==1&&j>1&&j<9)||(i==2&&j>0&&j<10)||(i==3&&j>0&&j<10)||(i>3&&i<9)||(i==9&&j>0&&j<10)||(i==10&&j>0&&j<10)||(i==11&&j>1&&j<9)||(i==12&&j>1&&j<9)||(i==13&&j>2&&j<8)||(i==14&&j>2&&j<8)||(i==15&&j>3&&j<7)||(i==16&&j>4&&j<6)){
								
								ctx.fillRect(this.x+(LARGURA/2)+j+Math.floor(Math.random()*100),this.y+ALTURA-18+i+Math.floor(Math.random()*100),this.largura,this.altura);
							
							}
							
						}
					}
					ctx.fillStyle="red";
					for (var i=0;i<17;i++){
						for(var j=0;j<11;j++){
							
							if((i==1&&j==4||i==1&&j==6)||(i==2&&j>2&&j<8)||(i==3&&j>2&&j<8)||(i==4&&j>1&&j<9)||(i==5&&j>1&&j<9)||(i==6&&j>1&&j<9)||(i==7&&j>1&&j<9)||(i==8&&j>1&&j<9)||(i==9&&j>2&&j<8)||(i==10&&j>2&&j<8)||(i==11&&j>3&&j<7)||(i==12&&j>3&&j<7)||(i==13&&j==5)){
								ctx.fillRect(this.x+(LARGURA/2)+j+Math.floor(Math.random()*100),this.y+ALTURA-18+i+Math.floor(Math.random()*100),this.largura,this.altura);
							
							}
							
						}
					}
					ctx.fillStyle="white";
					for (var i=0;i<7;i++){
						for(var j=0;j<3;j++){
							ctx.fillRect(this.x+(LARGURA/2)+4+j+Math.floor(Math.random()*100),this.y+ALTURA-16+i+Math.floor(Math.random()*100),this.largura,this.altura);
						}
					}
					
					for (var i=2;i<5;i++){
						for(var j=-1;j<4;j+=4){
							
							ctx.fillRect(this.x+(LARGURA/2)+4+j+Math.floor(Math.random()*100),this.y+ALTURA-16+i+Math.floor(Math.random()*100),this.largura,this.altura);
						}
					}
					
					for (var i=-1;i<8;i+=8){
						for(var j=1;j<2;j++){
							
							ctx.fillRect(this.x+(LARGURA/2)+4+j+Math.floor(Math.random()*100),this.y+ALTURA-16+i+Math.floor(Math.random()*100),this.largura,this.altura);
						}
					}
			}
			
		},
		gameover={
			x:0,
			y:0,
			altura:10,
			largura:10,
			desenha: function(){
				for(var i=0;i<170;i+=10){
					for(var j=0;j<340;j+=10){
						if(
							i==0&&j>10&&j<70||i==0&&j>100&&j<140||i==0&&j>170&&j<200||i==0&&j>220&&j<250||i==0&&j>260&&j<330||i==0&&j>100&&j<140||i==0&&j>170&&j<200||i==0&&j>220&&j<250||
							i==10&&j>0&&j<30||i==10&&j>90&&j<120||i==10&&j>120&&j<160||i==10&&j>170&&j<210||i==10&&j>210&&j<250||i==10&&j>260&&j<290||i==20&&j>-1&&j<20||i==20&&j>80&&j<110||
							i==20&&j>130&&j<160||i==20&&j>170&&j<250||i==20&&j>260&&j<290||
							i==30&&j>-1&&j<20||i==30&&j>30&&j<70||i==30&&j>80&&j<110||i==30&&j>130&&j<160||i==30&&j>170&&j<250||i==30&&j>260&&j<320||
							i==40&&j>-1&&j<20||i==40&&j>30&&j<70||i==40&&j>80&&j<160||i==40&&j>170&&j<250||i==40&&j>260&&j<290||
							i==50&&j>-1&&j<30||i==50&&j>40&&j<70||i==50&&j>80&&j<160||i==50&&j>170&&j<200||i==50&&j==210||i==50&&j>220&&j<250||i==50&&j>260&&j<290||
							i==60&&j>0&&j<70||i==60&&j>80&&j<110||i==60&&j>130&&j<160||i==60&&j>170&&j<200||i==60&&j>220&&j<250||i==60&&j>260&&j<330||
							i==70&&j>10&&j<70||i==70&&j>80&&j<110||i==70&&j>130&&j<160||i==70&&j>170&&j<200||i==70&&j>220&&j<250||i==70&&j>260&&j<330||
							i==90&&j>0&&j<60||i==90&&j>80&&j<110||i==90&&j>130&&j<160||i==90&&j>170&&j<250||i==90&&j>260&&j<330||
							i==100&&j>-1&&j<70||i==100&&j>80&&j<110||i==100&&j>80&&j<110||i==100&&j>130&&j<160||i==100&&j>170&&j<200||i==100&&j>260&&j<290||i==100&&j>310&&j<340||
							i==0&&j>10&&j<70||i==0&&j>100&&j<140||i==0&&j>170&&j<200||i==0&&j>220&&j<250||i==0&&j>260&&j<330||i==0&&j>100&&j<140||i==0&&j>170&&j<200||i==0&&j>220&&j<250||
							i==110&&j>-1&&j<20||i==110&&j>40&&j<70||i==110&&j>80&&j<110||i==110&&j>130&&j<160||i==110&&j>170&&j<200||i==110&&j>260&&j<290||i==110&&j>310&&j<340||
							i==120&&j>-1&&j<20||i==120&&j>40&&j<70||i==120&&j>80&&j<120||i==120&&j>120&&j<160||i==120&&j>170&&j<230||i==120&&j>260&&j<290||i==120&&j>310&&j<340||
							i==130&&j>-1&&j<20||i==130&&j>40&&j<70||i==130&&j>80&&j<160||i==130&&j>170&&j<200||i==130&&j>260&&j<290||i==130&&j>300&&j<340||
							i==140&&j>-1&&j<20||i==140&&j>40&&j<70||i==140&&j>90&&j<150||i==140&&j>170&&j<200||i==140&&j>80&&j<110||i==70&&j>130&&j<160||i==140&&j>170&&j<200||i==140&&j>260&&j<320||
							i==150&&j>-1&&j<20||i==150&&j>40&&j<70||i==150&&j>100&&j<140||i==150&&j>170&&j<250||i==150&&j>260&&j<290||i==150&&j>290&&j<330||
							i==160&&j>1&&j<70||i==160&&j==120||i==160&&j>170&&j<250||i==160&&j>260&&j<290||i==160&&j>300&&j<340
						){
							ctx.fillStyle="white";
							ctx.fillRect((LARGURA-340)/2+this.x+j,(ALTURA-160)/2+this.y+i,this.largura,this.altura)
						}
					}
				}
			}
		};
		
		function coordClique(){
			coordx=event.clientX;
            coordy=event.clientY;
			
			
        
				
		}
		function soltaclick(){
			
		}
		function apertatecla(){
			
			
			if(event.keyCode===37&&event.keyCode!==39){
				movee=true;
				
				
			}
			if(event.keyCode===38&&event.keyCode!==40){				
				movec=true;
				
			}
			if(event.keyCode===39&&event.keyCode!==37){
				moved=true;
				
			}
			if(event.keyCode===40&&event.keyCode!==38){
				moveb=true;
				
			}
			if(event.keyCode===13){
				
				if(document.getElementById("nickname").value==""){
					alert("Insira um Nick")
				}else{
					click=true;	
				
											
					jogadores.insere();
					document.getElementById("nickname").value="";
					document.getElementById("nickname").disable;
					
					}
					
				
					
			}
			
		}
		function soltatecla(){
			
			
			if(event.keyCode===37&&event.keyCode!==39){
				movee=false;
				
				
			}
			if(event.keyCode===38&&event.keyCode!==40){				
				movec=false;
				
			}
			if(event.keyCode===39&&event.keyCode!==37){
				moved=false;
				
			}
			if(event.keyCode===40&&event.keyCode!==38){
				moveb=false;
				
			}
			if(event.keyCode===13){
				click=false;
			}
		}
		function movimentanave(){
			if(movee){
				nave.esquerda();
			}
			if(movec){
				nave.cima();
			}
			if(moveb){
				nave.baixo();
			}
			if (moved){
				nave.direita();
			}
			

		}
		
		function main(){
			ALTURA= window.innerHeight;
			LARGURA=window.innerWidth;
			if(LARGURA>=600){
				LARGURA=600;
				ALTURA=600;
			}
			
			canvas=document.createElement("canvas");
			canvas.width=LARGURA;
			canvas.height=ALTURA;
			canvas.style.border="1px solid #000";
			ctx=canvas.getContext("2d");
			document.body.appendChild(canvas);
			document.addEventListener("keydown",apertatecla);
			document.addEventListener("keyup",soltatecla);
			document.addEventListener("mousedown",coordClique);
			
			
			
				cometas.insere();
			
				
			iniciodejogo();
			
			
		}

		function roda(){
			
			i=0;
		
			
			
			if(!colisao())
				window.requestAnimationFrame(roda);
				else{
					
				}
				atualiza();
				
				
			

		}
		function colisao(){
			var bateu=false;
			for(i=0,tam=cometas._cometas.length;i<tam;i++){
				if(nave.y-cometas._cometas[i].y<=-535&&nave.x-cometas._cometas[i].x>=-320&&nave.x-cometas._cometas[i].x<=-280&&nave.y-cometas._cometas[i].y>=-580){
					posicaocometa=i;				
					bateu=true;
					teste1=true;
				}
			
			}
			return bateu;
				
			
		}
		function atualiza(){
			
			desenha();
			movimentanave();
			cometas.atualiza();
			if(tempoinsere>200&&cometas._cometas.length<4){
				cometas.insere();
				tempoinsere=0;
			}
			tempoinsere++;
			
		}
		function desenha(){
			ctx.clearRect(0,0,LARGURA,ALTURA);
			var cont=0;
			img.src='fundo1.jpg';
			ctx.fillStyle="white";
			ctx.font = "30px Arial black";
					
			ctx.drawImage(img, 0,-ALTURA+py++,LARGURA+1,1202);
			if(py==590){
				py=0;
			}
			
			
			
			for(i=0,tam=cometas._cometas.length;i<tam;i++){
				cont=cont+cometas._cometas[i].score;
			}
			contscore=cont;
			
			
			ctx.fillText("Score: "+cont, 30,30);
			cometas.desenha();
			cometas.desenhacolisao();			
			nave.desenhacolisao();
			
			
			if(pisca<10&&!colisao()){				
				nave.desenhaTurbina();
			}else if(pisca>10&&!colisao()){
				pisca=0;
			}
			if(!colisao()){
			
			nave.desenhaNave();
			}else if (colisao()){
				qtdranking=jogadores._jogadores.length;
				if(qtdranking>25){
					qtdranking=25;
				}
				if(jogadores._jogadores.length>0){
					jogadores._jogadores[jogadores._jogadores.length-1].jscore=contscore;
					jogadores.ordena();
				}
				ctx.clearRect(0,0,LARGURA,ALTURA);
				ctx.drawImage(img, 0,-ALTURA+py++,LARGURA+1,1202);
				nave.naveexplode();
				cometas.cometaexplode(posicaocometa);
				ctx.fillStyle="white";
				ctx.fillText("Score: "+contscore, 30,30);
				cometas._cometas.splice(posicaocometa,1)
				
				
				cometas.desenha();
				fimdejogo();
			}
			pisca++;
			
		}
		function iniciodejogo(){
			
				
				img.src='fundo1.jpg';
				ctx.clearRect(0,0,LARGURA,ALTURA);
				
				ctx.drawImage(img, 0,-ALTURA+py++,LARGURA+1,1202);
				if(py==590){
					py=0;
				}
				
			
				ctx.fillText("Score: "+contscore, 30,30);
				ctx.fillStyle="WHITE";
				ctx.font = "30px Arial black";
				
				ctx.fillText("PRESSIONE ENTER", LARGURA/2-150,ALTURA/2);
				ctx.fillText(" PARA COMEÇAR", LARGURA/2-140,ALTURA/2+50);
				ctx.font = "30px Arial black";
				

				
				if(click==true){
					roda();	
					
				}else{
					window.requestAnimationFrame(iniciodejogo);
				}
				
		}
		function fimdejogo(){
				
				img.src='fundo1.jpg';
				ctx.clearRect(0,0,LARGURA,ALTURA);
				
				
				ctx.drawImage(img, 0,-ALTURA+py++,LARGURA+1,1202);
				if(py==590){
					py=0;
				}
				
				nave.naveexplode();
				ctx.fillText("Score: "+contscore, 30,30);
				ctx.font = "30px Arial black";
				ctx.fillText("PRESSIONE ENTER", LARGURA/2-150,ALTURA/2+200);
				ctx.fillText(" PARA COMEÇAR", LARGURA/2-140,ALTURA/2+250);
				
				cometas._cometas.splice(posicaocometa,1)			
				ctx.fillStyle="blue";
			
				if(tempoinsere>200&&cometas._cometas.length<4){
				cometas.insere();
				tempoinsere=0;
				}
				tempoinsere++;
				cometas.desenha();
				cometas.atualiza();
				
				
				//jogadores.ordena();
				
				
				
				
				gameover.desenha();
				
				
				
				var distancia=0
				for(var i=0;i<qtdranking;i++){
					ctx.font = "15px Arial black";
					ctx.fillText(i+1+": "+jogadores._jogadores[i].nome+"  -  "+jogadores._jogadores[i].jscore, 10,40+(distancia+=15));
				}
				

				
				if(colisao&&click==true){
					//jogadores.ordena();
					reiniciojogo();
					roda();	
					
				}else{
					window.requestAnimationFrame(fimdejogo);
				}
				
		}
		function reiniciojogo(){
			
			
				for(var i=0;i<cometas._cometas.length;i++){
					cometas._cometas[i].score=0;
					cometas._cometas[i].y=-20;
							
					cometas._cometas[i].x=Math.floor(Math.random()*LARGURA);
					cometas._cometas[i].controlado=Math.floor(Math.random()*2);
					cometas._cometas[i].altura=1;			
					cometas._cometas[i].largura=1;
					cometas._cometas[i].cor="#a0a0a0";
					cometas._cometas[i].gravidade=0.005+Math.random()*0.008;
					cometas._cometas[i].velocidadeV=0;
					cometas._cometas[i].velocidadeH=0;
				}
				nave.x=0;
				nave.y=0;
				frames=0;
				tempoinsere=0;
				iniciaenter=false;
				movec=false;
				moveb=false;
				movee=false;
				moved=false;
				px=0;
				 py=0;
				 posicaocometa=0;
				 coordx=0;
				 coordy=0;
				 contscore=0;
				img.src='fundo1.jpg';
				ctx.clearRect(0,0,LARGURA,ALTURA);
				
				ctx.drawImage(img, 0,-ALTURA+py++,LARGURA+1,1202);
				
					
				
				
				
		}
		main();
		

	</script>
</body>
</html>