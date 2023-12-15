function Computer (processore, disco, ram) {
    this.processore = processore;
    this.disco = disco;
    this.ram = ram;
}

Computer.prototype.infoComputerConsole = function() {
    console.log("Processore " + this.processore + "\nDisco:" 
    + this.disco + "\nRAM:" + this.ram);
}

Computer.prototype.infoComputerDOM = function(id) {
    document.getElementById(id).innerHTML = 
        "<p>Processore: " + this.processore +"</p>"+
        "<p>Disco: " + this.disco + "</p>"+
        "<p>RAM: "+ this.ram +"</p>";
    
}

// vediamo sia nella modalità Prototype che con la classe, che sono uguali 
class Computer2 {
    constructor(processore, disco, ram) {
        this.processore = processore;
        this.disco = disco;
        this.ram = ram;
    }

    infoComputerConsole = function() {
        console.log("Processore " + this.processore + "\nDisco:" 
        + this.disco + "\nRAM:" + this.ram);
    }

    infoComputerDOM = function(id) {
        document.getElementById(id).innerHTML =
        `<p>Processore: ${this.processore} </p>
        <p>Disco: ${this.disco}</p>
        <p>RAM: ${this.ram}</p>`;
    }
}

const mioPC = new Computer("i7", "1TB", "32GB");
mioPC.infoComputerConsole();
mioPC.infoComputerDOM("miopc");

const mioPC2 = new Computer2("i5", "250GB", "8GB");
mioPC2.infoComputerConsole();
mioPC2.infoComputerDOM("miopc2");