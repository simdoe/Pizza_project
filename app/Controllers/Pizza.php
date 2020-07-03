<?php namespace App\Controllers;
use App\Models\PizzaModel;
class Pizza extends BaseController
{
	public function viewsPizza()
	{
        $data = [];
		helper(['form']);
        $pizza = new PizzaModel();
        $data['pizzas'] = $pizza->findAll();
		return view('index', $data);
	}

    public function addPizza()
	{
		$data = [];
		helper(['form']);

		if($this->request->getMethod() == "post"){
			helper(['form']);
			$rules = [
				'name'=>'required|alpha_space',
				'prize'=>'required|min_length[1]|max_length[50]',
				'ingredients'=>'required',
			];
			 if($this->validate($rules)){
				$pizzaModel = new PizzaModel();
				$id = $this->request->getVar('id');
				$pizzaName = $this->request->getVar('name');
				$pizzaPrice = $this->request->getVar('price');
				$pizzaIngredient = $this->request->getVar('ingredient');
				$pizzaData = array(
					'name'=>$pizzaName,
					'prize'=>$pizzaPrize,
					'ingredients'=>$pizzaIngredients
				);
				$pizza->update($id,$pizzaData);
				return redirect()->to('/pizza');
			}else{
				$data['validation'] = $this->validator;
				return view('/index',$data);
			}
		}
	}

    public function deletePizza($id)
    {
        $pizza = new PizzaModel();
        $pizza->delete($id);
        return redirect()->to('/pizza');
    }

    public function updatePizza()
	{
		helper(['form']);
		$data = [];

		if($this->request->getMethod() == 'post'){

			$rules = [
				'name' => 'required',
				'prize' => 'required',
				'ingredients' => 'required'
			];

			if(!$this->validate($rules)){
				$data['validation'] = $this->validator; 
			}else{
				$pizza = new PizzaModel();
				$id = $this->request->getVar('id');
				$newData = [
					'name' =>$this->request->getVar('name'),
					'prize' =>$this->request->getVar('prize'),
					'ingredients' =>$this->request->getVar('ingredients'),
				];

				$pizza->update($id,$newData);
				return redirect()->to('/pizza');
			}
		}

		return view('index', $data);
	}
	
	public function editPizza($id)
    {
        $pizza = new PizzaModel();
        $data['edit']= $pizza->find($id);
        return view('index', $data);
    }
	//--------------------------------------------------------------------
}
