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
				$newData = [
					'name' =>$this->request->getVar('name'),
					'prize' =>$this->request->getVar('prize'),
					'ingredients' =>$this->request->getVar('ingredients'),
				];

				$pizza->createPizza($newData);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration!!!');
				return redirect()->to('/pizza');
			}
		}

		return view('index', $data);
	}

    public function deletePizza($id)
    {
        $pizza = new PizzaModel();
        $pizza->delete($id);
        return redirect()->to('/pizza');
    }

    public function updatePizza()
	{
		if($this->request->getMethod() == "post"){
			helper(['form']);
			$rules = [
				'name'=>'required|alpha_space',
				'price'=>'required|min_length[1]|max_length[50]',
				'ingredient'=>'required',
			];
			 if($this->validate($rules)){
				$pizza = new PizzaModel();
				$id = $this->request->getVar('id');
				$pizzaName = $this->request->getVar('name');
				$pizzaPrice = $this->request->getVar('prize');
				$pizzaIngredient = $this->request->getVar('ingredients');
				$pizzaData = array(
					'name'=>$pizzaName,
					'prize'=>$pizzaPrice,
					'ingredients'=>$pizzaIngredient
				);
				$pizzaModel->update($id,$pizzaData);
				return redirect()->to('/pizza');
			}else{
				$data['validation'] = $this->validator;
				return view('/index',$data);
			}
		}
	}
	
	//--------------------------------------------------------------------
}
