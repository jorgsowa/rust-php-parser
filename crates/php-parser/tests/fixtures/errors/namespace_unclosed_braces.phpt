===source===
<?php namespace App {
===errors===
expected '}', found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "body": {
            "Braced": []
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
===php_error===
PHP Parse error:  Unclosed '{' in Standard input code on line 1
