===source===
<?php use B as PARENT;
===errors===
Cannot use B as PARENT because 'PARENT' is a special class name
===php_error===
PHP Fatal error:  Cannot use B as PARENT because 'PARENT' is a special class name in Standard input code on line 1
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
                  "B"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": {
                "name": "PARENT",
                "span": {
                  "start": 15,
                  "end": 21
                }
              },
              "span": {
                "start": 10,
                "end": 21
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
