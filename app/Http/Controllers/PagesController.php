<?php namespace itway\Http\Controllers;

use itway\Http\Requests;
use itway\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {


	/**
	 * about page
	 *
	 *
	 */
	public function about()
	{
        return view('pages.about');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
