===source===
<?php function f(callable $x) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "callable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 25
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 28
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
