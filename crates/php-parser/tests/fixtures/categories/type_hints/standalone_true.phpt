===config===
min_php=8.2
===source===
<?php function f(): true { return true; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Bool": true
                  },
                  "span": {
                    "start": 34,
                    "end": 38
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 39
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "true"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 20,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
