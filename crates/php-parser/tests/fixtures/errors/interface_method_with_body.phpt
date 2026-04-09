===source===
<?php interface Foo { public function bar() { echo 'body'; } }
===errors===
interface method cannot contain a body
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "Foo",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "body"
                            },
                            "span": {
                              "start": 51,
                              "end": 57,
                              "start_line": 1,
                              "start_col": 51
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 46,
                        "end": 59,
                        "start_line": 1,
                        "start_col": 46
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 61,
                "start_line": 1,
                "start_col": 22
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62,
    "start_line": 1,
    "start_col": 0
  }
}
