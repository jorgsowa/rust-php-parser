===source===
<?php
class Service {
    use Loggable, Cacheable, Serializable;
    public function run(): void {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Service",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "Loggable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 30,
                        "end": 38,
                        "start_line": 3,
                        "start_col": 8
                      }
                    },
                    {
                      "parts": [
                        "Cacheable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 40,
                        "end": 49,
                        "start_line": 3,
                        "start_col": 18
                      }
                    },
                    {
                      "parts": [
                        "Serializable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 51,
                        "end": 63,
                        "start_line": 3,
                        "start_col": 29
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 26,
                "end": 69,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "run",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 92,
                          "end": 96,
                          "start_line": 4,
                          "start_col": 27
                        }
                      }
                    },
                    "span": {
                      "start": 92,
                      "end": 96,
                      "start_line": 4,
                      "start_col": 27
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 100,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 101,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 101,
    "start_line": 1,
    "start_col": 0
  }
}
