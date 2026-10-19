===source===
<?php (void)someFn();
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "someFn"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 18
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 20
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 20
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
