===source===
<?php
$
===errors===
expected expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": "Error",
              "span": {
                "start": 7,
                "end": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 7
          }
        }
      },
      "span": {
        "start": 6,
        "end": 7
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 7
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or "{" or "$" in Standard input code on line 2
