===source===
<?php function test(): { }
===errors===
expected identifier, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
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
===php_error===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 1
