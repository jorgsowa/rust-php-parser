===description===
`numeric` and `resource` are valid interface names in PHP. The interface-name
reserved-word check must not reject them.
===source===
<?php
interface numeric {}
interface resource {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "numeric",
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "resource",
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 27,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
