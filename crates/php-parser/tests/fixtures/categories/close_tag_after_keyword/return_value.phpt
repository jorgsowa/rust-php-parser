===source===
<?php function f() { return 1 ?>x<?php }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 28,
                    "end": 29
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 29
              }
            },
            {
              "kind": {
                "InlineHtml": "x"
              },
              "span": {
                "start": 32,
                "end": 33
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
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
