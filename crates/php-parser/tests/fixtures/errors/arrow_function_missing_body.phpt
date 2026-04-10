===source===
<?php fn($x) =>;
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": "x",
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 9,
                    "end": 11
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": "Error",
                "span": {
                  "start": 15,
                  "end": 16
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
