<?php

# Line 170
/**
 * Site Categories v2
 * A new, modular ontology for Gazelle sites
 */

# Main Categories
# https://www.ncbi.nlm.nih.gov/books/NBK25464/
$Categories = [
    # ID = 1
    'Sequences' => [
      'Platforms' => $SeqPlatforms,
      'Formats'   => array_merge($SeqFormats, $ProtFormats, $PlainFormats),
    ],
  
    # ID = 2
    'Graphs' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($GraphXmlFormats, $GraphTxtFormats, $PlainFormats),
    ],
  
    # ID = 3
    'Systems' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($GraphXmlFormats, $GraphTxtFormats, $PlainFormats),
    ],
  
    # ID = 4
    'Geometric' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($GraphXmlFormats, $GraphTxtFormats, $PlainFormats),
    ],
  
    # ID = 5
    'Scalars+Vectors' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($GraphXmlFormats, $GraphTxtFormats, $PlainFormats),
    ],
  
    # ID = 6
    'Patterns' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($GraphXmlFormats, $GraphTxtFormats, $PlainFormats),
    ],
  
    # ID = 7
    'Constraints' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($GraphXmlFormats, $GraphTxtFormats, $PlainFormats),
    ],
  
    # ID = 8
    'Images' => [
      'Platforms' => $ImgPlatforms,
      'Formats'   => array_merge($ImgFormats, $PlainFormats),
    ],
  
    # ID = 9
    'Spatial' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($MapVectorFormats, $MapRasterFormats, $ImgFormats, $PlainFormats),
    ],
  
    # ID = 10
    'Models' => [
      'Platforms' => $GraphPlatforms,
      'Formats'   => array_merge($MapVectorFormats, $MapRasterFormats, $PlainFormats),
    ],
  
    # ID = 11
    'Documents' => [
      'Platforms' => $DocPlatforms,
      'Formats'   => array_merge($BinDocFormats, $CpuGenFormats, $PlainFormats),
    ],
  
    # ID = 12
    'Machine Data' => [
      'Platforms' => $RawPlatforms,
      'Formats'   => $PlainFormats,
    ],
  ];
  
  $GroupedCategories = $Categories;
  #$CategoryIcons = ['music.png', 'apps.png', 'ebook.png', 'audiobook.png', 'elearning.png', 'comedy.png', 'comics.png'];
  
  # Plain Formats
  $PlainFormats = [
    'CSV'   => ['csv'],
    'JSON'  => ['json'],
    'Text'  => ['txt'],
    'Other' => [],
  ];
  
  
  /**
   * Sequences
   */
  
  # Platforms
  $SeqPlatforms = [
  #$Media = [
    # DNA
    'Complete Genomics',
    'cPAS-BGI/MGI',
    'Helicos',
    'Illumina HiSeq',
    'Illumina MiSeq',
    'Ion Torrent',
    'Microfluidics',
    'Nanopore',
    'PacBio',
    'Roche 454',
    'Sanger',
    'SOLiD',
    # RNA, Protein, etc.
    'De Novo',
    'HPLC',
    'Mass Spec',
    'RNA-Seq',
    'Other',
  ];
  
  # Sequence Formats
  # https://www.ncbi.nlm.nih.gov/sra/docs/submitformats/
  $SeqFormats = [
  #$Containers = [
    'BAM'        => ['bam'],
    'CRAM'       => ['cram'],
    'EMBL'       => ['embl'],
    'FASTA'      => ['fa', 'fasta', 'fsa'],
    'FASTA+QUAL' => ['qual'],
    'CSFASTA'    => ['csfa', 'csfasta', 'csfsa'],
    'FASTQ'      => ['fastq', 'fq', 'sanfastq'],
    'GFF'        => ['gff', 'gff2', 'gff3'],
    'GTF'        => ['gtf'],
    'GenBank'    => ['gb', 'gbk', 'genbank'],
    'HDF5'       => ['bash5', 'baxh5', 'fast5', 'h5', 'hdf5'],
    'PIR'        => ['pir'],
    'QSeq'       => ['qseq'],
    'SAM'        => ['sam'],
    'SFF'        => ['sff'],
    'SRF'        => ['srf'],
    'SnapGene'   => ['dna', 'seq'],
    'SwissProt'  => ['dat'],
    'VCF'        => ['vcf'],
  ];
  
  # Protein Formats
  # DON'T PARSE RAW FILES. TOO MANY COMPETING VENDORS
  # https://www.ncbi.nlm.nih.gov/pmc/articles/PMC3518119/
  $ProtFormats = [
  #$ContainersProt = [
    'ABI/Sciex'      => ['t2d', 'wiff'],
    'APML'           => ['apml'],
    'ASF'            => ['asf'],
    'Agilent/Bruker' => ['baf', 'd', 'fid', 'tdf', 'yep'],
    'BlibBuild'      => ['blib'],
    'Bruker/Varian'  => ['sms', 'xms'],
    'Finnigan'       => ['dat', 'ms'],
    'ION-TOF'        => ['ita', 'itm'],
    'JCAMP-DX'       => ['jdx'],
    'MGF'            => ['mgf'],
    'MS2'            => ['ms2'],
    'MSF'            => ['msf'],
    'mzData'         => ['mzdata'],
    'mzML'           => ['mzml'],
    'mzXML'          => ['mzxml'],
    'OMSSA'          => ['omssa', 'omx'],
    'PEFF'           => ['peff'],
    'pepXML'         => ['pepxml'],
    'protXML'        => ['protxml'],
    'Shimadzu'       => ['lcd', 'qgd', 'spc'],
    'Skyline'        => ['sky', 'skyd'],
    'TPP/SPC'        => ['dta'],
    'Tandem'         => ['tandem'],
    'TraML'          => ['traml'],
    'ULVAC-PHI'      => ['tdc'],
  ];  
  
  
  /**
   * Graphs
   */
  
  # Graph Platforms
  # https://en.wikipedia.org/wiki/Graph_drawing#Software
  $GraphPlatforms = [
    'BioFabric',
    'BioTapestry',
    'Cytoscape',
    'Edraw Max',
    'GenMAPP',
    'Gephi',
    'graph-tool',
    'Graphviz',
    'InCroMAP',
    'LaNet-vi',
    'Linkurious',
    'MATLAB',
    'MEGA',
    'Maple',
    'Mathematica',
    'Microsoft Automatic Graph Layout',
    'NetworkX',
    'Other',
    'PGF/TikZ',
    'PathVisio',
    'Pathview',
    'R',
    'Systrip',
    'Tom Sawyer Software',
    'Tulip',
    'yEd',
  ];
  
  # XML Graph Formats
  $GraphXmlFormats = [
    'DGML' => ['dgml'],
    'DotML' => ['dotml'],
    'GEXF' => ['gexf'],
    'GXL' => ['gxl'],
    'GraphML' => ['graphml'],
    'XGMML' => ['xgmml'],
  ];
  
  # Text Graph Formats
  $GraphTxtFormats = [
    'DOT'    => ['gv'],
    'GML'    => ['gml'],
    'LCF'    => ['lcf'],
    'Newick' => ['xsd', 'sgf'],
    'SIF'    => ['sif'],
    'TGF'    => ['tgf'],
  ];
  
  
  /**
   * Images
   */
  
  # Image Platforms
  $ImgPlatforms = [
  #$MediaManga = [
    'CT/CAT',
    'ECG',
    'Elastography',
    'FNIR/NIRS',
    'MPI',
    'MRI/NMR',
    'Microscopy',
    'Photoacoustic',
    'Photography',
    'Scint/SPECT/PET',
    'Ultrasound',
    'X-Rays',
    'Other',
  ];
  
  # Image Formats
  # https://www.ncbi.nlm.nih.gov/pmc/articles/PMC3948928/
  $ImgFormats = [
  #$ContainersGames = [
    'Analyze'   => ['hdr', 'img'],
    'Interfile' => ['h33'],
    'DICOM'     => ['dcm', 'dicom'],
    'HDF5'      => ['bash5', 'baxh5', 'fast5', 'h5', 'hdf5'],
    'NIfTI'     => ['nii', 'nifti'],
    'MINC'      => ['minc', 'mnc'],
    'JPEG'      => ['jfif', 'jpeg', 'jpg'],
    'JPEG 2000' => ['j2k', 'jp2', 'jpf', 'jpm', 'jpx', 'mj2'],
    'PNG'       => ['png'],
    'TIFF'      => ['tif', 'tiff'],
    'WebP'      => ['webp'],
  ];
  
  
  /**
   * Spatial
   */
  
  # Vector Map Formats
  $MapVectorFormats = [
    'AutoCAD DXF' => ['dxf'],
    'Cartesian Coordinates' => ['xyz'],
    'DLG' => ['dlg'],
    'Esri TIN' => ['adf', 'dbf'],
    'GML' => ['gml'],
    'GeoJSON' => ['geojson'],
    #'GeoMedia' => [''],
    'ISFC' => ['isfc'],
    'KML' => ['kml', 'kmzv'],
    # DAT omitted
    # https://en.wikipedia.org/wiki/MapInfo_TAB_format
    'MapInfo TAB' => ['tab', 'ind', 'map', 'id'],
    'Measure Map Pro' => ['mmp'],
    'NTF' => ['ntf'],
    # DBF omitted
    # https://en.wikipedia.org/wiki/Shapefile
    'Shapefile' => ['shp', 'shx'],
    #'Simple Features' => [''],
    'Spatial Data File' => ['sdf', 'sdf3', 'sif', 'kif'],
    #'SpatiaLite' => [''],
    'SOSI' => ['sosi'],
    'SVG' => ['svg'],
    'TIGER' => ['tiger'],
    'VPF' => ['vpf'],
  ];
  
  # Raster Map Formats
  $MapRasterFormats = [
    'ADRG'      => ['adrg'],
    'Binary'    => ['bsq', 'bip', 'bil',],
    'DRG'       => ['drg'],
    'ECRG'      => ['ecrg'],
    'ECW'       => ['ecw'],
    # DAT and ASC omitted (common)
    # https://support.esri.com/en/technical-article/000008526
    # https://web.archive.org/web/20150128024528/http://docs.codehaus.org/display/GEOTOOLS/ArcInfo+ASCII+Grid+format
    'Esri Grid' => ['adf', 'nit', 'asc', 'grd' ],
    'GeoTIFF'   => ['tfw'],
    #'IMG'      => ['img'],
    #'JPEG2000' => ['j2k', 'jp2', 'jpf', 'jpm', 'jpx', 'mj2'],
    'MrSID'     => ['sid'],
    'netCDF'    => ['nc'],
    'RPF'       => ['cadrg', 'cib'],
  ];
  
  
  /**
   *  Documents 
   */
  
  $DocPlatforms = [
    # Composed
    'Literature',
    'Software',
    # Generated
    'Kernel',  
    'Metadata',
    'Notebook',
    'Other',
  ];
  
  # Binary Document Formats
  # https://en.wikipedia.org/wiki/OpenDocument
  # https://en.wikipedia.org/wiki/List_of_Microsoft_Office_filename_extensions
  $BinDocFormats = [
    'OpenDocument' => ['odt', 'fodt', 'ods', 'fods', 'odp', 'fodp', 'odg', 'fodg', 'odf'],
    'Word'         => ['doc', 'dot', 'wbk', 'docx', 'docm', 'dotx', 'dotm', 'docb'],
    'PowerPoint'   => ['ppt', 'pot', 'pps', 'pptx', 'pptm', 'potx', 'potm', 'ppam', 'ppsx', 'ppsm', 'sldx', 'sldm'],
    'Excel'        => ['xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw'],
    'PDF'          => ['pdf', 'fdf', 'xfdf'],
  ];
  
  # Extra Formats
  # DON'T PARSE IMG OR ISO FILES
  # https://en.wikipedia.org/wiki/Disk_image#File_formats
  # http://dcjtech.info/topic/python-file-extensions/
  $CpuGenFormats = [
    'Docker'       => ['dockerfile'],
    'Hard Disk'    => ['fvd', 'dmg', 'esd', 'qcow', 'qcow2', 'qcow3', 'smi', 'swm', 'vdi', 'vhd', 'vhdx', 'vmdk', 'wim'],
    'Optical Disc' => ['bin', 'ccd', 'cso', 'cue', 'daa', 'isz', 'mdf', 'mds', 'mdx', 'nrg', 'uif'],
    'Python'       => ['pxd', 'py', 'py3', 'pyc', 'pyd', 'pyde', 'pyi', 'pyo', 'pyp', 'pyt', 'pyw', 'pywz', 'pyx', 'pyz', 'rpy', 'xpy'],
    'Jupyter'      => ['ipynb'],
    'Ontology'     => ['cgif', 'cl', 'clif', 'csv', 'htm', 'html', 'kif', 'obo', 'owl', 'rdf', 'rdfa', 'rdfs', 'rif', 'tsv', 'xcl', 'xht', 'xhtml', 'xml'],
  ];
  
  
  /**
   *  Machine Data 
   */
  
  $RawPlatforms = [
    'Binary',
    'Text',
  ];
  
  
  # Archives
  $Archives = [
    '7z'       => ['7z'],
    'bzip2'    => ['bz2', 'bzip2'],
    'gzip'     => ['gz', 'gzip', 'tgz', 'tpz'],
    'Pickle'   => ['pickle', 'pkl'],
    'RAR'      => ['rar', 'rev'],
    'ZIP'      => ['zip', 'zipx'],
    'None'     => [''],
  ];
# Line 556  