===source===
<?php $x = 'unclosed;
===errors===
unterminated string literal
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ''unclosed;' (T_ENCAPSED_AND_WHITESPACE) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected string content "unclosed;" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "unclosed;"
                },
                "span": {
                  "start": 11,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
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
