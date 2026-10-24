===source===
<?php
new fn;
===errors===
expected class name, found 'fn'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'fn' (T_FN) in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "fn" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "fn", expecting "class" in Standard input code on line 2
===ast===
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
                      "fn"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 12
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 12
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
