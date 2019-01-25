<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\Http\Resources\Quote as QuoteResource;

use MongoDB\Client as Mongo;
use App\Mongo\Service;

class QuoteController extends Controller
{

    private $service;

    public function postQuote(Request $request)
    {
        $quote = new Quote();
        $quote->content = $request->input('content');
        $quote->author = $request->input('author');
        $quote->save();
        return response()->json(['quote' => $quote], 201);
    }
    public function getQuotes()
    {
        $quotes = Quote::all();
        /*$this->service = new Service($uri = null, $uriOptions = [], $driverOptions = []);
        $collection = $this->service->get()->{'laravel-ng2-vue'}->quotes;
        $quotes = $collection->find()->toArray();*/
        $response = [
          'quotes' => $quotes
        ];
        return response()->json($response, 200);
    }
    public function putQuote(Request $request, $id)
    {
        $quote = Quote::find($id);
        if (!$quote) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $quote->content = $request->input('content');
        $quote->author = $request->input('author');
        $quote->save();
        return response()->json(['quote' => $quote], 200);
    }
    public function deleteQuote($id)
    {
        $quote = Quote::find($id);
        $quote->delete();
        return response()->json(['message' => 'Quote deleted'], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->service = new Service($uri = null, $uriOptions = [], $driverOptions = []);
        $collection = $this->service->get()->{'laravel-ng2-vue'}->quotes;
        $quotes = $collection->find()->toArray();
        $response = [
          'quotes' => $quotes
        ];
        return response()->json($response, 200);

        //return new QuoteCollection(Quote::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->service = new Service($uri = null, $uriOptions = [], $driverOptions = []);
        $collection = $this->service->get()->{'laravel-ng2-vue'}->quotes;

        $request->validate([
            'content' => 'required|max:255',
        ]);

        $insertOneResult = $collection->insertOne([
            'content' => $request->get('content')
        ]);

        return redirect('quotes')->with('success', 'Quote has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->service = new Service($uri = null, $uriOptions = [], $driverOptions = []);
        $collection = $this->service->get()->{'laravel-ng2-vue'}->quotes;

        $visita = $collection->findOne(['_id' => new \MongoDB\BSON\ObjectID($id)]);

        return($visita);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->service = new Service($uri = null, $uriOptions = [], $driverOptions = []);
        $collection = $this->service->get()->{'laravel-ng2-vue'}->quotes;

        $quote = $collection->findOne(['_id' => new \MongoDB\BSON\ObjectID($id)]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->service = new Service($uri = null, $uriOptions = [], $driverOptions = []);
        $collection = $this->service->get()->{'laravel-ng2-vue'}->quotes;

        $quoteUpdate = $collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectID($id)],
            ['$set' => ['content' => $request->get('content')]]
        );

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service = new Service($uri = null, $uriOptions = [], $driverOptions = []);
        $collection = $this->service->get()->{'laravel-ng2-vue'}->quotes;

        $quoteDelete = $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectID($id)]);

        return response()->json(null, 204);
    }
}