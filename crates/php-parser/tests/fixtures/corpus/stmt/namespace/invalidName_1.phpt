===source===
<?php use A as self;
===errors===
Cannot use A as self because 'self' is a special class name
===php_error===
PHP Fatal error:  Cannot use A as self because 'self' is a special class name in Standard input code on line 1
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
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": {
                "name": "self",
                "span": {
                  "start": 15,
                  "end": 19
                }
              },
              "span": {
                "start": 10,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
