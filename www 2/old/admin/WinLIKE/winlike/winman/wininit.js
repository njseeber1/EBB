/* WinLIKE 1.1.00  (c) 1998-2004 by CEITON technologies GmbH - www.ceiton.com
   all rights reserved - patent pending */
v_=document;N_=null;T_=true;F_=false;_R_=0;a_=new Object;WinLIKE=a_;a_.init=be_;function c_(a,b){return a.indexOf(b)}function L_(a){return a.location}g_=0;p_=0;z_=navigator.userAgent;bt_=z_.length;ba_="MSIE";c3_="rv:";if(c_(z_,c3_)>0){z_=z_.slice(c_(z_,c3_)+3,bt_);bc_=parseFloat(z_);z_=z_.slice(3,bt_);cE_=parseFloat(z_);isNaN(cE_)?0:bc_+=cE_/10;p_=!isNaN(bc_)&&bc_>0.91}else if(c_(z_,ba_)>0&&c_(z_,'Wind')>0&&c_(z_,'Oper')==-1&&c_(z_,'mdkc')==-1){z_=z_.slice(c_(z_,ba_)+5,bt_);bc_=parseFloat(z_);g_=!isNaN(bc_)&&bc_>5.4}(!g_&&!p_)?L_(document).replace(WinLIKEerrorpage):0;a_.ie=g_;function be_(){eb_='__';_R_++;if(window.name==eb_||_R_>1)return;bB_=0;d8_='/';bu_=0;ay_=N_;ee_='1_';ef_='2_';e__='3_';eg_='4_';ei_='x';ea_='y';ec_='_';du_=d8_+d8_+d8_+d8_;B_=new Array('Mn','Ed','Cls','Tit','HD','Min','Mov','Siz','Vis','Fro','Bac','SD','LD','Rel',"b8_","dg_","_Q_","_P_",'Del','Mx');m_=new Array('Nam','onUnload','onClose','onEvent',"Ttl",'Ski',"Height","Width","Left","Top","RWidth","RHeight","RLeft","RTop",'Adr');bD_();ci_(ee_);ci_(ef_);ci_(e__);ci_(eg_)}