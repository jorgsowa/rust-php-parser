===source===
<?php match ($x) {
===errors===
expected '}', found end of file
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              },
              "arms": []
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
===php_error===
PHP Parse error:  Unclosed '{' in Standard input code on line 1
