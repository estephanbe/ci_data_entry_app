<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
	{
		$this->title = 'الصفحة الرئيسية';
	}
	
	public function index()
	{
		// $this->view_data['entries'] = array(
		// 	[
		// 		"id" => 1,
		// 		"name"=> "بشارة",
		// 		"country" => "الأردن",
		// 		"nationality" => "أردني",
		// 		"occupation" => "مبرمج",
		// 		"photo_url" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAXVBMVEX/3IezeRz/34r/4YytcAqwdBTbrlr41H+/ijL/4oyvcxGxdhj+2oXrw2/UpVHFkTvnvmrLmUTiuGTzzXi3fiPOnknIlkDDjzj20HvftGC+iC+1fB+oaAC6gynwyHSl+4JbAAAD4UlEQVR4nO2c2VLcQAxFcTcGPGZJWEICCf//mXEWisVnvDBUWao65xE8VS364pau1HN0JCIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiY04n2Hptn0G5+Hm8l75uvbxPoH7tm73snsrW6/sEdvsDbPq7/JtYvkxF2PT597BeTYh0kOlF+hDPj6cCbPqv2WVafrSTETbt1is8lO5sUqSDTL8kl+nptEgHmX7LLdNyMiPSYRPPt17kQXS/5gJsdtepZXozJ9JBpvfd1qs8gHo5K9KmOc4s0zof33Be/Mgr0/I0mbE9y/Qhr0zr3cxh+F+meavEAgHCj9qTrDKlsqKnbf2V9dCv38bRHJdHkOnN1kv9IOewhfcdHCDtZU6ZlutxhLvr+gRJwG1OmXb3Y5EOSWhFmabcRCgr+qs65DnjwPvLjJtIte+fLJvTgIwRUlnxt1KiVC6lXfOdRcqZTkZXscCp8K8ULBcg04SuYr0FLf7/FaQ1+eyaArXvsyWDMk1n19CZ8LxPKNPdxgteTRnH8BJEgco/m11D2/QiRGpH/XvP5oFieHmZYLcmm10DIbz270mmqewaKite92BQpmeZ7Bpqqb0+8Vimmewaaqm1b0RIKk5k11BZ8bZRSAZHJlexPoBI31QPLNPvm614LdRSa99JkB5JI1Nqqb0vj7C9n8ZVrFT7vitx6TzJ4ypSS21U/4HV2LRJ7BpqqY1reJTpY5IIxysHHwZlmmMIjL208cpJpjnsmqVGUwXDOIddg+UtqA9niTK4ijypR+Kj5DXDEBhmnHgKVBqXSjAERi+Q3U1Xx3TXJNPwriIeAs0Z8gBPxncVqaU2rBuBBxO4irOTenNEdxUXTOrNEH0IbMGk3hzBXUVoqa0l9hAYtdTWEttVpJbaaiK7ioUmSVYT2a5ZOKk3R2C7hlpqHyCuq4idzw8Qdwhs8pbaGuIOgX3OFg4yDWrXcFnxEaIOgc3cUltFzAj5llrfToN/lZh2Dd9Say9PprmjT8V0FTtoqQ10ZQbMZEO6ilj7zr8zOA+KKFOufeff+5wmRHQVqaW2qNXCqV5AuwZvqS1pl+2RaThXkW+pLUlOuJMTbwiMb6k9LinX+aPRrpby+2JZkcDbH81V5H+mZdcoaNg2nqtYMOm+XbbIDt2dWHYNt9SWVrLs0MVyFamltmJ4BF3WWENg1FJbUaqzUx5Jplz7LrdbOOOL5Cryl1+smHDijlUgV/HgBXLlFWcI7HCR7aueo8i0PtLXeP1c4+ue4veB7aJEeBQshRQREREREREREREREREREREREREREREREREREREREdma38DULju5AqS1AAAAAElFTkSuQmCC",
		// 	],
		// 	[
		// 		"id" => 2,
		// 		"name" => "خالد",
		// 		"country" => "قطر",
		// 		"nationality" => "أمريكي",
		// 		"occupation" => "مدير",
		// 		"photo_url" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAXVBMVEX/3IezeRz/34r/4YytcAqwdBTbrlr41H+/ijL/4oyvcxGxdhj+2oXrw2/UpVHFkTvnvmrLmUTiuGTzzXi3fiPOnknIlkDDjzj20HvftGC+iC+1fB+oaAC6gynwyHSl+4JbAAAD4UlEQVR4nO2c2VLcQAxFcTcGPGZJWEICCf//mXEWisVnvDBUWao65xE8VS364pau1HN0JCIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiY04n2Hptn0G5+Hm8l75uvbxPoH7tm73snsrW6/sEdvsDbPq7/JtYvkxF2PT597BeTYh0kOlF+hDPj6cCbPqv2WVafrSTETbt1is8lO5sUqSDTL8kl+nptEgHmX7LLdNyMiPSYRPPt17kQXS/5gJsdtepZXozJ9JBpvfd1qs8gHo5K9KmOc4s0zof33Be/Mgr0/I0mbE9y/Qhr0zr3cxh+F+meavEAgHCj9qTrDKlsqKnbf2V9dCv38bRHJdHkOnN1kv9IOewhfcdHCDtZU6ZlutxhLvr+gRJwG1OmXb3Y5EOSWhFmabcRCgr+qs65DnjwPvLjJtIte+fLJvTgIwRUlnxt1KiVC6lXfOdRcqZTkZXscCp8K8ULBcg04SuYr0FLf7/FaQ1+eyaArXvsyWDMk1n19CZ8LxPKNPdxgteTRnH8BJEgco/m11D2/QiRGpH/XvP5oFieHmZYLcmm10DIbz270mmqewaKite92BQpmeZ7Bpqqb0+8Vimmewaaqm1b0RIKk5k11BZ8bZRSAZHJlexPoBI31QPLNPvm614LdRSa99JkB5JI1Nqqb0vj7C9n8ZVrFT7vitx6TzJ4ypSS21U/4HV2LRJ7BpqqY1reJTpY5IIxysHHwZlmmMIjL208cpJpjnsmqVGUwXDOIddg+UtqA9niTK4ijypR+Kj5DXDEBhmnHgKVBqXSjAERi+Q3U1Xx3TXJNPwriIeAs0Z8gBPxncVqaU2rBuBBxO4irOTenNEdxUXTOrNEH0IbMGk3hzBXUVoqa0l9hAYtdTWEttVpJbaaiK7ioUmSVYT2a5ZOKk3R2C7hlpqHyCuq4idzw8Qdwhs8pbaGuIOgX3OFg4yDWrXcFnxEaIOgc3cUltFzAj5llrfToN/lZh2Dd9Say9PprmjT8V0FTtoqQ10ZQbMZEO6ilj7zr8zOA+KKFOufeff+5wmRHQVqaW2qNXCqV5AuwZvqS1pl+2RaThXkW+pLUlOuJMTbwiMb6k9LinX+aPRrpby+2JZkcDbH81V5H+mZdcoaNg2nqtYMOm+XbbIDt2dWHYNt9SWVrLs0MVyFamltmJ4BF3WWENg1FJbUaqzUx5Jplz7LrdbOOOL5Cryl1+smHDijlUgV/HgBXLlFWcI7HCR7aueo8i0PtLXeP1c4+ue4veB7aJEeBQshRQREREREREREREREREREREREREREREREREREREREdma38DULju5AqS1AAAAAElFTkSuQmCC",
		// 	],
		// 	[
		// 		"id" => 3,
		// 		"name" => "سعيد",
		// 		"country" => "الأردن",
		// 		"nationality" => "أردني",
		// 		"occupation" => "عامل نظافة",
		// 		"photo_url" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAXVBMVEX/3IezeRz/34r/4YytcAqwdBTbrlr41H+/ijL/4oyvcxGxdhj+2oXrw2/UpVHFkTvnvmrLmUTiuGTzzXi3fiPOnknIlkDDjzj20HvftGC+iC+1fB+oaAC6gynwyHSl+4JbAAAD4UlEQVR4nO2c2VLcQAxFcTcGPGZJWEICCf//mXEWisVnvDBUWao65xE8VS364pau1HN0JCIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiY04n2Hptn0G5+Hm8l75uvbxPoH7tm73snsrW6/sEdvsDbPq7/JtYvkxF2PT597BeTYh0kOlF+hDPj6cCbPqv2WVafrSTETbt1is8lO5sUqSDTL8kl+nptEgHmX7LLdNyMiPSYRPPt17kQXS/5gJsdtepZXozJ9JBpvfd1qs8gHo5K9KmOc4s0zof33Be/Mgr0/I0mbE9y/Qhr0zr3cxh+F+meavEAgHCj9qTrDKlsqKnbf2V9dCv38bRHJdHkOnN1kv9IOewhfcdHCDtZU6ZlutxhLvr+gRJwG1OmXb3Y5EOSWhFmabcRCgr+qs65DnjwPvLjJtIte+fLJvTgIwRUlnxt1KiVC6lXfOdRcqZTkZXscCp8K8ULBcg04SuYr0FLf7/FaQ1+eyaArXvsyWDMk1n19CZ8LxPKNPdxgteTRnH8BJEgco/m11D2/QiRGpH/XvP5oFieHmZYLcmm10DIbz270mmqewaKite92BQpmeZ7Bpqqb0+8Vimmewaaqm1b0RIKk5k11BZ8bZRSAZHJlexPoBI31QPLNPvm614LdRSa99JkB5JI1Nqqb0vj7C9n8ZVrFT7vitx6TzJ4ypSS21U/4HV2LRJ7BpqqY1reJTpY5IIxysHHwZlmmMIjL208cpJpjnsmqVGUwXDOIddg+UtqA9niTK4ijypR+Kj5DXDEBhmnHgKVBqXSjAERi+Q3U1Xx3TXJNPwriIeAs0Z8gBPxncVqaU2rBuBBxO4irOTenNEdxUXTOrNEH0IbMGk3hzBXUVoqa0l9hAYtdTWEttVpJbaaiK7ioUmSVYT2a5ZOKk3R2C7hlpqHyCuq4idzw8Qdwhs8pbaGuIOgX3OFg4yDWrXcFnxEaIOgc3cUltFzAj5llrfToN/lZh2Dd9Say9PprmjT8V0FTtoqQ10ZQbMZEO6ilj7zr8zOA+KKFOufeff+5wmRHQVqaW2qNXCqV5AuwZvqS1pl+2RaThXkW+pLUlOuJMTbwiMb6k9LinX+aPRrpby+2JZkcDbH81V5H+mZdcoaNg2nqtYMOm+XbbIDt2dWHYNt9SWVrLs0MVyFamltmJ4BF3WWENg1FJbUaqzUx5Jplz7LrdbOOOL5Cryl1+smHDijlUgV/HgBXLlFWcI7HCR7aueo8i0PtLXeP1c4+ue4veB7aJEeBQshRQREREREREREREREREREREREREREREREREREREREdma38DULju5AqS1AAAAAElFTkSuQmCC",
		// 	],
		// 	[
		// 		"id" => 4,
		// 		"name" => "عامر",
		// 		"country" => "قطر",
		// 		"nationality" => "عراقي",
		// 		"occupation" => "مبرمج",
		// 		"photo_url" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAXVBMVEX/3IezeRz/34r/4YytcAqwdBTbrlr41H+/ijL/4oyvcxGxdhj+2oXrw2/UpVHFkTvnvmrLmUTiuGTzzXi3fiPOnknIlkDDjzj20HvftGC+iC+1fB+oaAC6gynwyHSl+4JbAAAD4UlEQVR4nO2c2VLcQAxFcTcGPGZJWEICCf//mXEWisVnvDBUWao65xE8VS364pau1HN0JCIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiY04n2Hptn0G5+Hm8l75uvbxPoH7tm73snsrW6/sEdvsDbPq7/JtYvkxF2PT597BeTYh0kOlF+hDPj6cCbPqv2WVafrSTETbt1is8lO5sUqSDTL8kl+nptEgHmX7LLdNyMiPSYRPPt17kQXS/5gJsdtepZXozJ9JBpvfd1qs8gHo5K9KmOc4s0zof33Be/Mgr0/I0mbE9y/Qhr0zr3cxh+F+meavEAgHCj9qTrDKlsqKnbf2V9dCv38bRHJdHkOnN1kv9IOewhfcdHCDtZU6ZlutxhLvr+gRJwG1OmXb3Y5EOSWhFmabcRCgr+qs65DnjwPvLjJtIte+fLJvTgIwRUlnxt1KiVC6lXfOdRcqZTkZXscCp8K8ULBcg04SuYr0FLf7/FaQ1+eyaArXvsyWDMk1n19CZ8LxPKNPdxgteTRnH8BJEgco/m11D2/QiRGpH/XvP5oFieHmZYLcmm10DIbz270mmqewaKite92BQpmeZ7Bpqqb0+8Vimmewaaqm1b0RIKk5k11BZ8bZRSAZHJlexPoBI31QPLNPvm614LdRSa99JkB5JI1Nqqb0vj7C9n8ZVrFT7vitx6TzJ4ypSS21U/4HV2LRJ7BpqqY1reJTpY5IIxysHHwZlmmMIjL208cpJpjnsmqVGUwXDOIddg+UtqA9niTK4ijypR+Kj5DXDEBhmnHgKVBqXSjAERi+Q3U1Xx3TXJNPwriIeAs0Z8gBPxncVqaU2rBuBBxO4irOTenNEdxUXTOrNEH0IbMGk3hzBXUVoqa0l9hAYtdTWEttVpJbaaiK7ioUmSVYT2a5ZOKk3R2C7hlpqHyCuq4idzw8Qdwhs8pbaGuIOgX3OFg4yDWrXcFnxEaIOgc3cUltFzAj5llrfToN/lZh2Dd9Say9PprmjT8V0FTtoqQ10ZQbMZEO6ilj7zr8zOA+KKFOufeff+5wmRHQVqaW2qNXCqV5AuwZvqS1pl+2RaThXkW+pLUlOuJMTbwiMb6k9LinX+aPRrpby+2JZkcDbH81V5H+mZdcoaNg2nqtYMOm+XbbIDt2dWHYNt9SWVrLs0MVyFamltmJ4BF3WWENg1FJbUaqzUx5Jplz7LrdbOOOL5Cryl1+smHDijlUgV/HgBXLlFWcI7HCR7aueo8i0PtLXeP1c4+ue4veB7aJEeBQshRQREREREREREREREREREREREREREREREREREREREdma38DULju5AqS1AAAAAElFTkSuQmCC",
		// 	],
		// 	[
		// 		"id" => 5,
		// 		"name" => "خليل",
		// 		"country" => "البحرين",
		// 		"nationality" => "أردني",
		// 		"occupation" => "مبرمج",
		// 		"photo_url" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAXVBMVEX/3IezeRz/34r/4YytcAqwdBTbrlr41H+/ijL/4oyvcxGxdhj+2oXrw2/UpVHFkTvnvmrLmUTiuGTzzXi3fiPOnknIlkDDjzj20HvftGC+iC+1fB+oaAC6gynwyHSl+4JbAAAD4UlEQVR4nO2c2VLcQAxFcTcGPGZJWEICCf//mXEWisVnvDBUWao65xE8VS364pau1HN0JCIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiY04n2Hptn0G5+Hm8l75uvbxPoH7tm73snsrW6/sEdvsDbPq7/JtYvkxF2PT597BeTYh0kOlF+hDPj6cCbPqv2WVafrSTETbt1is8lO5sUqSDTL8kl+nptEgHmX7LLdNyMiPSYRPPt17kQXS/5gJsdtepZXozJ9JBpvfd1qs8gHo5K9KmOc4s0zof33Be/Mgr0/I0mbE9y/Qhr0zr3cxh+F+meavEAgHCj9qTrDKlsqKnbf2V9dCv38bRHJdHkOnN1kv9IOewhfcdHCDtZU6ZlutxhLvr+gRJwG1OmXb3Y5EOSWhFmabcRCgr+qs65DnjwPvLjJtIte+fLJvTgIwRUlnxt1KiVC6lXfOdRcqZTkZXscCp8K8ULBcg04SuYr0FLf7/FaQ1+eyaArXvsyWDMk1n19CZ8LxPKNPdxgteTRnH8BJEgco/m11D2/QiRGpH/XvP5oFieHmZYLcmm10DIbz270mmqewaKite92BQpmeZ7Bpqqb0+8Vimmewaaqm1b0RIKk5k11BZ8bZRSAZHJlexPoBI31QPLNPvm614LdRSa99JkB5JI1Nqqb0vj7C9n8ZVrFT7vitx6TzJ4ypSS21U/4HV2LRJ7BpqqY1reJTpY5IIxysHHwZlmmMIjL208cpJpjnsmqVGUwXDOIddg+UtqA9niTK4ijypR+Kj5DXDEBhmnHgKVBqXSjAERi+Q3U1Xx3TXJNPwriIeAs0Z8gBPxncVqaU2rBuBBxO4irOTenNEdxUXTOrNEH0IbMGk3hzBXUVoqa0l9hAYtdTWEttVpJbaaiK7ioUmSVYT2a5ZOKk3R2C7hlpqHyCuq4idzw8Qdwhs8pbaGuIOgX3OFg4yDWrXcFnxEaIOgc3cUltFzAj5llrfToN/lZh2Dd9Say9PprmjT8V0FTtoqQ10ZQbMZEO6ilj7zr8zOA+KKFOufeff+5wmRHQVqaW2qNXCqV5AuwZvqS1pl+2RaThXkW+pLUlOuJMTbwiMb6k9LinX+aPRrpby+2JZkcDbH81V5H+mZdcoaNg2nqtYMOm+XbbIDt2dWHYNt9SWVrLs0MVyFamltmJ4BF3WWENg1FJbUaqzUx5Jplz7LrdbOOOL5Cryl1+smHDijlUgV/HgBXLlFWcI7HCR7aueo8i0PtLXeP1c4+ue4veB7aJEeBQshRQREREREREREREREREREREREREREREREREREREREdma38DULju5AqS1AAAAAElFTkSuQmCC",
		// 	],
		// );
		// echo view('templates/header', $this->view_data );
		// echo view('home', $this->view_data );
		// echo view('templates/footer', $this->view_data );
	}
}
