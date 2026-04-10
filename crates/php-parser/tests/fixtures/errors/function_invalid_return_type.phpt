===source===
<?php function test(): { }
===errors===
expected identifier, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "<error>"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 23,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 23,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
