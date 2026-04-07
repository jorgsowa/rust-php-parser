===source===
<?php
/**
 * @template T of object
 * @template-covariant TValue
 */
class Collection {
    /**
     * @param T $item
     * @return list<T>
     */
    public function add(object $item): array {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Collection",
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
                "Method": {
                  "name": "add",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "item",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "object"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 173,
                              "end": 179
                            }
                          }
                        },
                        "span": {
                          "start": 173,
                          "end": 179
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
                        "start": 173,
                        "end": 185
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 188,
                          "end": 193
                        }
                      }
                    },
                    "span": {
                      "start": 188,
                      "end": 193
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 153,
                "end": 197
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 69,
        "end": 198
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 198
  }
}
