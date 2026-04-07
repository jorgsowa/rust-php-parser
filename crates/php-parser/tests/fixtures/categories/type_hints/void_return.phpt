===source===
<?php function f(): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
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
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
