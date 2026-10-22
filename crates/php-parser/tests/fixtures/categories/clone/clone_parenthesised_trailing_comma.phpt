===source===
<?php $copy = clone($obj, );
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 1
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
                  "Variable": "copy"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Variable": "obj"
                    },
                    "span": {
                      "start": 20,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
