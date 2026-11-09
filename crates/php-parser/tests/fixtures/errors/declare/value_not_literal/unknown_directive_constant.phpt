===source===
<?php
declare(foo=FOO);
===errors===
declare(foo) value must be a literal
===php_error===
PHP Fatal error:  declare(foo) value must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "foo",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 18,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 21
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
