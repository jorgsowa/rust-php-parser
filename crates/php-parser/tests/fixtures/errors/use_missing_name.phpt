===source===
<?php use;
===errors===
expected identifier, found ';'
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [],
                "kind": "Error",
                "span": {
                  "start": 9,
                  "end": 10
                }
              },
              "alias": null,
              "span": {
                "start": 9,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10
  }
}
