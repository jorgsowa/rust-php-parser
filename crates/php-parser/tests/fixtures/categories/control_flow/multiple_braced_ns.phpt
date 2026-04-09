===source===
<?php namespace A { function foo() {} } namespace B { function bar() {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 18,
              "start_line": 1,
              "start_col": 16
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": "foo",
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 20,
                  "end": 37,
                  "start_line": 1,
                  "start_col": 20
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 50,
              "end": 52,
              "start_line": 1,
              "start_col": 50
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": "bar",
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 54,
                  "end": 71,
                  "start_line": 1,
                  "start_col": 54
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 40,
        "end": 73,
        "start_line": 1,
        "start_col": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73,
    "start_line": 1,
    "start_col": 0
  }
}
