===source===
<?php
new readonly();
===errors 8.2===
'readonly anonymous classes' requires PHP 8.3 or higher
expected 'class', found '('
===errors >=8.3===
expected 'class', found '('
===php_error 8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "(", expecting "class" in Standard input code on line 2
===ast <=8.1===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "readonly"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 18
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": "Error",
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
