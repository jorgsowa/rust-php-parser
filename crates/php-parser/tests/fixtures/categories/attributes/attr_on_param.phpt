===source===
<?php function foo(#[Validate] int $x) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 31,
                      "end": 34
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "Validate"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 29
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 21,
                    "end": 29
                  }
                }
              ],
              "span": {
                "start": 19,
                "end": 37
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
