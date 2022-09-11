<?php 
// Single responsibility principle
// A class should have only one reason to change
// A class should have only one responsibility
// A class should have only one job
// SRP - Single responsibility principle (Klassen har kun én grund til at ændre) violation example

class Document {
    protected $title;
    protected $content;

    public function __construct(string $title, string $content) 
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    
    public function exportHtml() {
        echo "DOCUMENT EXPORTED TO HTML".PHP_EOL;
        echo "Title: ".$this->getTitle().PHP_EOL;
        echo "Content: ".$this->getContent().PHP_EOL.PHP_EOL;
    }

    public function exportPdf() {
        echo "DOCUMENT EXPORTED TO PDF".PHP_EOL;
        echo "Title: ".$this->getTitle().PHP_EOL;
        echo "Content: ".$this->getContent().PHP_EOL.PHP_EOL;
    }
}

// SRP - Single responsibility principle (Klassen har kun én grund til at ændre) following example
interface ExportableDocumentInterface {
    public function export(Document $document);
}

class HtmlExportableDocument implements ExportableDocumentInterface {
    public function export(Document $document) {
        echo "DOCUMENT EXPORTED TO HTML".PHP_EOL;
        echo "Title: ".$document->getTitle().PHP_EOL;
        echo "Content: ".$document->getContent().PHP_EOL.PHP_EOL;
    }
}

class PdfExportableDocument implements ExportableDocumentInterface {
    public function export(Document $document) {
        echo "DOCUMENT EXPORTED TO PDF".PHP_EOL;
        echo "Title: ".$document->getTitle().PHP_EOL;
        echo "Content: ".$document->getContent().PHP_EOL.PHP_EOL;
    }
}

class Document {
    protected $title;
    protected $content;

    public function __construct(string $title, string $content) 
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function export(ExportableDocumentInterface $exporter) {
        $exporter->export($this);
    }
}
?>