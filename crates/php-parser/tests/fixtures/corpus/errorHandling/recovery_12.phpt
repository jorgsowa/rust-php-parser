===source===
<?php
new
===errors===
expected identifier, found end of file
expected ';' after expression
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected end of file, expecting "class" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": "Error",
                "span": {
                  "start": 9,
                  "end": 9
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 9
          }
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 9
  }
}
