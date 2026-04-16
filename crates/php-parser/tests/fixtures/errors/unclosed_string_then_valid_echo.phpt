===source===
<?php $x = 'unterminated
 echo 'hello';
===errors===
unterminated string literal
expected ';' after expression
expected ';' after expression
expected ';' after expression
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
                  "String": "unterminated\n echo "
                },
                "span": {
                  "start": 11,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "hello"
          },
          "span": {
            "start": 32,
            "end": 37
          }
        }
      },
      "span": {
        "start": 32,
        "end": 37
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": ";"
          },
          "span": {
            "start": 37,
            "end": 39
          }
        }
      },
      "span": {
        "start": 37,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected identifier "hello" in Standard input code on line 2
