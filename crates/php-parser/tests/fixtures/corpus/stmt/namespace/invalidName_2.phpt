===source===
<?php use B as PARENT;
===errors===
expected identifier, found 'parent'
expected ';', found 'parent'
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
            "Name": {
              "parts": [
                "parent"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 15,
                "end": 21
              }
            }
          },
          "span": {
            "start": 15,
            "end": 21
          }
        }
      },
      "span": {
        "start": 15,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
