===source===
<?php function test(): { }
===errors===
expected identifier, found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [],
                "kind": "Error",
                "span": {
                  "start": 23,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 23,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
