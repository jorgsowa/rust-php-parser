===source===
<?php
declare(encoding=FOO);
===errors===
Encoding must be a literal
===php_error===
PHP Fatal error:  Encoding must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "encoding",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 26
                }
              }
            ]
          ],
          "body": null
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
