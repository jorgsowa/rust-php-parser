===source===
<?php use A as self;
===errors===
expected identifier, found 'self'
expected ';', found 'self'
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
              "alias": null,
              "span": {
                "start": 10,
                "end": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "self"
          },
          "span": {
            "start": 15,
            "end": 19
          }
        }
      },
      "span": {
        "start": 15,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
===php_error===
PHP Fatal error:  Cannot use A as self because 'self' is a special class name in Standard input code on line 1
