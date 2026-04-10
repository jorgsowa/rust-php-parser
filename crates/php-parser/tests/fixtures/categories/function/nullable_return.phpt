===source===
<?php function foo(): ?int { return null; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 36,
                    "end": 40
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 41
              }
            }
          ],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
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
            },
            "span": {
              "start": 22,
              "end": 26
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
