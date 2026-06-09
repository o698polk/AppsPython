class Calculator {
    constructor(previousOperandTextElement, currentOperandTextElement) {
        this.previousOperandTextElement = previousOperandTextElement;
        this.currentOperandTextElement = currentOperandTextElement;
        this.clear();
    }

    clear() {
        this.currentOperand = '0';
        this.previousOperand = '';
        this.operation = undefined;
    }

    delete() {
        if (this.currentOperand === '0') return;
        this.currentOperand = this.currentOperand.toString().slice(0, -1);
        if (this.currentOperand === '') this.currentOperand = '0';
    }

    appendNumber(number) {
        if (number === '.' && this.currentOperand.includes('.')) return;
        if (this.currentOperand === '0' && number !== '.') {
            this.currentOperand = number.toString();
        } else {
            this.currentOperand = this.currentOperand.toString() + number.toString();
        }
    }

    chooseOperation(operation) {
        if (this.currentOperand === '0' && operation === '-') {
            this.currentOperand = '-';
            this.updateDisplay();
            return;
        }
        
        if (this.currentOperand === '' || this.currentOperand === '-') return;
        
        if (operation === '%') {
            this.currentOperand = (parseFloat(this.currentOperand) / 100).toString();
            this.updateDisplay();
            return;
        }

        if (this.previousOperand !== '') {
            this.compute();
        }
        this.operation = operation;
        this.previousOperand = this.currentOperand;
        this.currentOperand = '';
    }

    compute() {
        let computation;
        const prev = parseFloat(this.previousOperand);
        const current = parseFloat(this.currentOperand);
        
        if (isNaN(prev) || isNaN(current)) return;
        
        switch (this.operation) {
            case '+':
                computation = prev + current;
                break;
            case '-':
                computation = prev - current;
                break;
            case '×':
                computation = prev * current;
                break;
            case '÷':
                if (current === 0) {
                    alert("No se puede dividir por cero");
                    this.clear();
                    return;
                }
                computation = prev / current;
                break;
            default:
                return;
        }
        
        // Handle floating point precision issues
        computation = Math.round(computation * 100000000) / 100000000;
        
        this.currentOperand = computation.toString();
        this.operation = undefined;
        this.previousOperand = '';
    }

    getDisplayNumber(number) {
        if (number === '-') return '-';
        
        const stringNumber = number.toString();
        const integerDigits = parseFloat(stringNumber.split('.')[0]);
        const decimalDigits = stringNumber.split('.')[1];
        
        let integerDisplay;
        if (isNaN(integerDigits)) {
            integerDisplay = '';
        } else {
            integerDisplay = integerDigits.toLocaleString('en', { maximumFractionDigits: 0 });
        }
        
        if (decimalDigits != null) {
            return `${integerDisplay}.${decimalDigits}`;
        } else {
            return integerDisplay;
        }
    }

    updateDisplay() {
        this.currentOperandTextElement.innerText = this.getDisplayNumber(this.currentOperand);
        if (this.operation != null) {
            this.previousOperandTextElement.innerText = 
                `${this.getDisplayNumber(this.previousOperand)} ${this.operation}`;
        } else {
            this.previousOperandTextElement.innerText = '';
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const previousOperandTextElement = document.getElementById('previous-operand');
    const currentOperandTextElement = document.getElementById('current-operand');
    const calculator = new Calculator(previousOperandTextElement, currentOperandTextElement);

    const buttons = document.querySelectorAll('.btn');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const action = button.dataset.action;
            const value = button.dataset.value;

            if (!action) {
                calculator.appendNumber(value);
            } else if (action === 'operator') {
                calculator.chooseOperation(value);
            } else if (action === 'calculate') {
                calculator.compute();
            } else if (action === 'clear') {
                calculator.clear();
            } else if (action === 'delete') {
                calculator.delete();
            }

            calculator.updateDisplay();
        });
    });

    // Keyboard support
    document.addEventListener('keydown', e => {
        if (e.key >= '0' && e.key <= '9' || e.key === '.') {
            calculator.appendNumber(e.key);
            calculator.updateDisplay();
        }
        if (e.key === '=' || e.key === 'Enter') {
            e.preventDefault();
            calculator.compute();
            calculator.updateDisplay();
        }
        if (e.key === 'Backspace') {
            calculator.delete();
            calculator.updateDisplay();
        }
        if (e.key === 'Escape') {
            calculator.clear();
            calculator.updateDisplay();
        }
        if (e.key === '+' || e.key === '-') {
            calculator.chooseOperation(e.key);
            calculator.updateDisplay();
        }
        if (e.key === '*' || e.key === 'x') {
            calculator.chooseOperation('×');
            calculator.updateDisplay();
        }
        if (e.key === '/') {
            e.preventDefault();
            calculator.chooseOperation('÷');
            calculator.updateDisplay();
        }
        if (e.key === '%') {
            calculator.chooseOperation('%');
            calculator.updateDisplay();
        }
    });
});
