===source===
<?php abstract class Foo { abstract function bar() { echo 'body'; } }
===errors===
abstract method cannot contain a body
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": true,
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
                              "start": 58,
                              "end": 64,
                              "start_line": 1,
                              "start_col": 58
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 53,
                        "end": 66,
                        "start_line": 1,
                        "start_col": 53
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 68,
                "start_line": 1,
                "start_col": 27
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 69,
        "start_line": 1,
        "start_col": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69,
    "start_line": 1,
    "start_col": 0
  }
}
