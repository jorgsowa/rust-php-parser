===source===
<?php #[Route("/api")] function foo() {}
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 40
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 32,
              "end": 35
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Route"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "/api"
                      },
                      "span": {
                        "start": 14,
                        "end": 20
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 20
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 21
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
